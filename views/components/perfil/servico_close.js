var servicoClose = {
    props: {
        url_get_servico: {
            type: String
        },
        url_get_mensagens: {
            type: String
        }
    },
    data() {
        return {
            lista_contatos: [], //deve ser buscado no banco todas as mensagens que tenha id desse usuário, e ele vai escolher qual dos usuários que ele conversou ele contratou.

            servico_id: this.$route.params.id, //id do servilo que vem da url
            contratante_id: user.id, //id do usuário que criou o serviço - e usuário logado
            contratado_id: '', //id do contratato que será escolhido da lista
            data: '', //data do momento em que é finalizado o serviço
            valor: '', //se houve mudança no valor do serviço na negociação deve ser editado no serviço, com o novo valor
            // o status do servico deve ser mudado para finalizado 
            metodo_pagamento: '' //metodo de pagamento que foi usado nesse serviço
        }
    },
    template: `
    <div class="edit_servico_perfil">
        <form action="url_finalizar_servico" method="post">
            <input type="hidden" name="servico_id" :value="servico_id" />
            <input type="hidden" name="contratante_id" :value="contratante_id" />
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="metodo_pagamento" class="required">Método pagameto</label>
                    <select class="form-control" id="metodo_pagamento" name="metodo_pagamento" v-model="metodo_pagamento" required>
                        <option value="dinheiro" selected>Dinheiro - Espécie</option>
                        <option value="cartao">Catão - Crédito/Débito</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label for="contratado" class="required">Contratado</label>
                    <select class="form-control" id="contratado" name="contratado_id" v-model="contratado_id" required>
                        <option :value="ctt.id" v-for="ctt in lista_contatos" :key="ctt.id">
                            {{ctt.nome}}
                        </option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control" v-model="valor" id="valor">
                </div>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-dark btn-md btn-block rounded-pill" v-if="metodo_pagamento && contratado_id && valor">
                    Finalizar
                </button>
                <button type="button" class="btn btn-dark btn-md btn-block rounded-pill" disabled v-else>
                    Finalizar
                </button>
            </div>
        </form>
    </div>
    `,
    mounted() {

        axios.get(this.url_get_servico + "/?s=" + this.servico_id) //pega o servico no banco pelo id do serviço
            .then(res => {
                this.data_servico = res;
                this.valor = this.data_servico.valor
                // console.log(this.data_servico);
            })
            .catch(err => {
                console.error("erro na requisição");
            })
        axios.get(this.url_get_mensagens + "/?s=" + this.contratante_id) //pega os mensagens no banco pelo id do usuário, onde contratante_id seja igual ao id do usuário
            .then(res => {
                this.data_mensagens = res;
                // console.log(this.data_mensagens);

                if (this.data_mensagens.lenght > 0) {
                    this.data_mensagens.forEach(e => { //percorre todas as mensagens deste usuario logado e pega todos os usuários con quem ele conversou e adiciona a uma lista de contatos pra ele escolher quem foi que ele contratou.
                        this.lista_contatos.push({ id: e.contratado_id, nome: e.nome })
                    });
                } else {
                    // window.location.href = "/jobfinder/profile"; //caso não haja nenhum contato pra escolher um contratado a págna não vai permitir que ele finalize o serviço, redirecionando ele para a pagina de perfil
                }
            })
            .catch(err => {
                console.error("erro na requisição");
            })
    }
}