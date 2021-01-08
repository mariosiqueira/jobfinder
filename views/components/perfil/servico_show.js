var servicoShow = {
    props: {
        url_get_servico: {
            type: String,
        }
    },
    data() { 
        return {
            id: this.$route.params.id,

            titulo: '',
            descricao: '',
            endereco_servico: '',
            valor: '',

        }
    },
    template: `
    <div class="edit_servico_perfil">
        <form action="url_edit_servico" method="post">
            <input type="hidden" name="servico_id" :value="id" />
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="" class="required">Titulo</label>
                    <input type="text" class="form-control" name="titulo" v-model="titulo" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="" class="required">Descricao</label>
                    <input type="text" class="form-control" name="descricao" v-model="descricao" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="">Endereço</label>
                    <input type="text" class="form-control" name="endereco_servico" v-model="endereco_servico">
                </div>
                <div class="col-md-12 form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control" name="valor" v-model="valor" id="valor">
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
        //Requisição assíncrona com axios para pegar todos os atributos pelo id do serviço selecionado para visualizar e preencher nos campos na aplicação.
        axios.get('/controller/get_data_servico.php?s='+this.id) //get servico 
            .then((res) => {
                this.titulo = res.data.titulo;
                this.descricao = res.data.descricao;
                this.endereco_servico = res.data.enderecoServico;
                this.valor = res.data.valor;
            })
            .catch(err => {
                console.error("erro na requisição");
                // alert();
            })
    }
}