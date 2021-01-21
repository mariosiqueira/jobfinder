var servicoClose = {
    props: {
        homeurl: {
            required: true
        },
        url_get_servico: {
            type: String
        },
        url_get_mensagens: {
            type: String
        }
    },
    data() {
        return {
            contatos: [],
            lista_contatos: [], //deve ser buscado no banco todas as mensagens que tenha id desse usuário, e ele vai escolher qual dos usuários que ele conversou ele contratou.
            metodo_pagamento: '', //metodo de pagamento que foi usado nesse serviço
            servico_id: this.$route.params.id, //id do servilo que vem da url
            contratante_id: user.id, //id do usuário que criou o serviço - e usuário logado
            contratado_id: '', //id do contratato que será escolhido da lista
            // o status do servico deve ser mudado para finalizado 
            comentario: "" //comentario da avaliação
        }
    },
    template: `
    <div class="edit_servico_perfil">
        <form :action="homeurl + 'services/close'" method="post">
            <input type="hidden" name="servico_id" :value="servico_id" />
            <input type="hidden" name="contratante_id" :value="contratante_id" />
            <div class="form-row">
                <div class="col-md-8 form-group">
                    <label for="metodo_pagamento" class="required">Método pagameto</label>
                    <select class="form-control" id="metodo_pagamento" name="metodo_pagamento" v-model="metodo_pagamento" required>
                        <option value="dinheiro" selected>Dinheiro - Espécie</option>
                        <option value="cartao">Catão - Crédito/Débito</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="valor_job" class="required">Valor final</label>
                    <input type="text" class="form-control" name="valor_final" id="valor_job">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="contratado" class="required">Contratado</label>
                    <select class="form-control" id="contratado" name="contratado_id" v-model="contratado_id" required>
                        <option :value="ctt.id" v-for="ctt in contatos" :key="ctt.id">
                            {{ctt.nome +' - '+ ctt.email}}
                        </option>
                    </select>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" checked id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&#9733;</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="comentario" rows="3" v-model="comentario">Comentário sobre o contratado</textarea>
                </div>            
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-dark btn-md btn-block rounded-pill text-uppercase" v-if="metodo_pagamento && contratado_id && comentario">
                    Finalizar
                </button>
                <button type="button" class="btn btn-dark btn-md btn-block rounded-pill text-uppercase" disabled v-else>
                    Finalizar
                </button>
            </div>
        </form>
    </div>
    `,
    mounted() {
        this.getContatos();
    },
    methods: {
        getContatos(){
            axios.post(this.homeurl + 'usuarios/todos_contatos', {id : user.id})
            .then(res => {
                if (res.data.status != false) {        
                    this.contatos = res.data.contatos;
                }
            })
            .catch(err => {
                console.error("erro na requisição");
                console.error(err);
            })
        }
    }
}