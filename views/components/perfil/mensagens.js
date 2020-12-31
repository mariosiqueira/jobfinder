var MessagesComponent = {
    props: {
        homeurl:{
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
            data_ctts: [],
            mensagem: "", //mensagem
            from: "", //contratado_id
        }
    },
    mounted() {
        this.msgs = JSON.parse(atob(this.mensagens));
        this.data_ctts = JSON.parse(atob(this.contatos));
    },
    template: `
    <div class="mt-5">
        <div class="row m-0 profile-msg">
            <div class="col-lg-3 list-contatos">
                <p class="alert alert-primary text-center" v-if="data_ctts.length == 0" role="alert">
                    <strong>Nenhuma mensagem encontrada</strong>
                </p>
                <p class="profile-msg-contatos" v-else v-for="contato in data_ctts" :key="contato.id" @click="loadMensagens(contato.id)">
                    <img class="profile-msg-contatos-img mr-1" :src="homeurl +'files/'+ contato.fotoPerfil" />
                    <span class="profile-msg-contatos-username">{{contato.id +" " +contato.nome}}</span>
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
            // como alternativa pode usar o axios pra buscar no banco as mensagens pelo id do usuario atual, logado na session
            /**
             * axios.get(url)
             *      .then(res=>{
             *          this.data = res
             *      })
             *      .catch(err => {
             *          console.log(err);
             * })
             * 
             */



            this.from = id;
            let aux = [];
            this.msgs.forEach(e => {
                if (e.contratante_id == id || e.contratado_id == id) {
                    aux.push(e);
                }
            });
            this.data = aux;
            this.scrolToBottom();
            this.$refs.mensagem.focus();

        },
        sendMensagem() {
            if (this.from != "") {

                if (this.mensagem && this.mensagem != "") { //verifica se a mensagem não está vazia
                    
                    this.data.push(
                        {
                            'contratante_id': this.user_id,
                            'contratado_id': this.from,
                            'mensagem': this.mensagem
                        }
                    )
                    
                    // falta implementar o chat realtime com ratchet

                    // axios.post(this.urlenviarmsg) //retorna uma promise
                    //     .then(res => {  //se retornar sucesso ele entra no then
                    //         this.data.push(res);
                    //         this.scrolToBottom();
                    //     })
                    //     .catch(err => { //se retornar um erro ele entra no catch
                    //         console.error(err);
                    //     })

                    this.scrolToBottom();
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

        }
    }
}
