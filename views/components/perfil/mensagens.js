var MessagesComponent = {
    props: {
        mensagens: { //todas as mensagem que pertence ao usuario atual que está logado na session
            required: true
        },
        urlenviarmsg: { //url que a mensagem será enviada
            type: String
        }
    },
    data() {
        return {
            user_id: 1, //contratante_id
            data: [],
            mensagem: "", //mensagem
            from: "" //contratado_id
        }
    },
    mounted(){
        this.msgs = JSON.parse(atob(this.mensagens));
    },
    template: `
    <div>
        <h1 class="text-muted text-uppercase">Mensagens</h1>
        <div class="my-4"></div>
        <div class="row m-0 profile-msg">
            <div class="col-lg-3 list-contatos">
                <p class="profile-msg-contatos" @click="loadMensagens('1')">
                    <img class="profile-msg-contatos-img mr-1" src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg" />
                    <span class="profile-msg-contatos-username">username</span>
                </p>
                <p class="profile-msg-contatos" @click="loadMensagens('2')">
                    <img class="profile-msg-contatos-img mr-1" src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg" />
                    <span class="profile-msg-contatos-username">username</span>
                </p>
            </div>
            <div class="col-lg-9">
                <div class="profile-msg-body" ref="profile_scrol">
                    <ul class="messages_body">
                        <li v-for="m in data" :key="m.id">
                            <p :class="m.to == user_id ? 'sended' : 'received'">
                                {{m.mensagem}} 
                            </p>
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="sendMensagem()">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" v-model="mensagem" placeholder="Mensagem"  aria-describedby="send">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="send">
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
                if (e.to == id || e.from == id) {
                    aux.push(e);
                }
            });
            this.data = aux;
            this.scrolToBottom();
        },
        sendMensagem() {
            if (this.from != "") {
                this.data.push(
                    {
                        'to': this.user_id,
                        'from': this.from,
                        'mensagem': this.mensagem
                    }
                )

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
