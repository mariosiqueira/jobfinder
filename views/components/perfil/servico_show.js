var servicoShow = {
    props: {
        url_get_servico: {
            type: String
        }
    },
    data() {
        return {
            id: this.$route.params.id,

            titulo: "teste serviço",
            descricao: "teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço teste serviço",
            endereco_servico: "afogados da ingazeira, centro, 22",
            duracao: "1 hora",
            valor: 100,

            // duracao_1: this.duracao.split(" ")[0],
            // duracao_2: this.duracao.split(" ")[1],
        }
    },
    template: `
    <div class="edit_servico_perfil">
        <form action="url_edit_servico" method="post">
            <input type="hidden" name="servico_id" :value="id" />
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="" class="required">Titulo</label>
                    <input type="text" class="form-control" v-model="titulo" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="" class="required">Descricao</label>
                    <input type="text" class="form-control" v-model="descricao" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="">Endereço</label>
                    <input type="text" class="form-control" v-model="endereco_servico">
                </div>
                <div class="col-md-12 form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control" v-model="valor" id="valor">
                </div>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success btn-md btn-block rounded-pill">
                    Salvar
                </button>
            </div>
        </form>
    </div>
    `,
    mounted() {

        axios.get(this.url_get_servico + "/?s=" + this.id) //get servico 
            .then(res => {
                this.data_servico = res;
            })
            .catch(err => {
                console.error("erro na requisição");
                // alert();
            })
    }
}