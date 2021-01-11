var MessagesComponent = {
    props: {
        homeurl: {
            required: true
        },
        mensagens: { //todas as mensagem que pertence ao usuario atual que está logado na session
            required: true
        },
        urlenviarmsg: { //url que a mensagem será enviada
            type: String
        },
        contatos: { //todas os usuarios que mandaram mensagem pra o usuário atual logado
            required: true
        }
    },
    data() {
        return {
            user_id: user.id, //contratante_id
            data: [],
            msgs: [],
            data_ctts: [],
            mensagem: "", //mensagem
            from: "", //contratado_id
            focused: false,
            conn: null,
            channel: null,
        }
    },
    mounted() {
        this.msgs = JSON.parse(atob(this.mensagens));
        this.data_ctts = JSON.parse(atob(this.contatos));
    },
    created() {
        this.connect();
    },
    template: `
    <div class="mt-5">
        <div class="row m-0 profile-msg">
            <div class="col-lg-3 list-contatos">
                <p class="alert alert-primary text-center" v-if="data_ctts.length == 0" role="alert">
                    <strong>Nenhuma mensagem encontrada</strong>
                </p>
                <p class="profile-msg-contatos" v-else v-for="contato in data_ctts" :key="contato.id" @click="loadMensagens(contato.id)">
                    <img class="profile-msg-contatos-img mr-1" :src="homeurl +'src/files/'+ contato.fotoPerfil" />
                    <span class="profile-msg-contatos-username">{{contato.nome}}</span>
                </p>
            </div>
            <div class="col-lg-9">
                <div class="profile-msg-body" ref="profile_scrol">
                    <ul class="messages_body">
                        <li v-for="m in data" :key="m.id">
                            <div :class="m.contratante_id == user_id ? 'sended' : 'received'">
                                <p :class="m.contratante_id == user_id ? 'msg-sended' : 'msg-received'">
                                    {{m.mensagem}} 
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="sendMensagem()">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control shadow-none" v-model="mensagem" placeholder="Mensagem" ref="mensagem" required>
                        <div class="input-group-append">
                            <button type="submit" v-if="mensagem" class="btn btn-success shadow-none" id="send">
                                Enviar
                            </button>
                            <button type="button" v-else disabled class="btn btn-success shadow-none" id="send">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    `,
    methods: {
        loadMensagens(id) {
            this.focused = true;
            this.from = id;
            let aux = [];
            this.msgs.forEach(e => { //percore todas as mensagens do usuario logado
                if (e.contratante_id == id || e.contratado_id == id) { //pega so as mensagens do usuario logado e do contato que ele clicou
                    aux.push(e); //adiciona todas em um array
                }
            });
            this.data = aux;
            this.scrolToBottom(); //da scroll pra baixo
            this.$refs.mensagem.focus(); //da focus no campo de input de mensagem

        },
        async sendMensagem() { //função pra o usuario enviar a mensagem
            if (this.from != "") { //verifica se o usuario de destino da mensagem nao esta vazio

                if (this.mensagem && this.mensagem != "") { //verifica se a mensagem não está vazia

                    var aux = { //objeto da mensagem
                        'contratante_id': this.user_id,
                        'contratado_id': this.from,
                        'mensagem': this.mensagem,
                        "sala": this.from //sala é o id do ususario da mensagem de destino, ou seja so o usuario com id igual ao do contratado_id podera visualiza-la
                    };
                    this.data.push(aux); //adiciona a mensagem enviada ao array de todas as mensagens

                    this.axiosSend({
                        'contratante_id': this.user_id,
                        'contratado_id': this.from,
                        'mensagem': this.mensagem
                    })

                    // this.send(aux); //socket envia a mensagem

                    this.scrolToBottom(); //faz scroll pra baixo
                    this.mensagem = ""; //reseta o valor d mensagem
                }

            } else {
                alert("Entre em uma conversa!")
            }
        },
        scrolToBottom() { //da um scrol até em baixo nas mensagens

            setTimeout(() => {
                this.$refs.profile_scrol.scrollTop = this.$refs.profile_scrol.scrollHeight - this.$refs.profile_scrol.clientHeight;
            }, 50);

        },
        connect() {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            this.conn = new Pusher('d94eb47625dbc86a8533', {  //cria uma conexao socket
                cluster: 'eu'
            });

            this.channel = this.conn.subscribe('jobfinder-chat'); //fica escutando esse canal
            this.channel.bind('send-message', data => this.salvarMensagem(data)); //fica escultando esse canal por onde  toda mensagem recebida pelo socket passa
        },
        
        async axiosSend(data) {
            await axios.post(this.homeurl + 'usuarios/salvar_mensagem', data);
        },
        salvarMensagem(msg) { //função pra quando uma nova mensagem é recebida no metodo onmessage.
            var data = msg;

            if (data.contratado_id == this.user_id) { //verifica se a mensagem recebida tem o id da sala igual ao id do usuario logado
                if (this.focused) { //verifica se ele ta com o campode de mensagem aberta
                    this.msgs.push(data); //adiciona a todas as mesagens
                    this.data.push(data); //adiciona a mensagem a tela pra ele ver
                    this.scrolToBottom(); //scroll pra baixo

                } else { //se ele nao estiver com a tela aberta adiciona a mensagem so em todas as mensagens
                    this.msgs.push(data);
                }
            }
        }
    }
}
