var servicoShow = {
    props: {
        url_get_servico: {
            type: String,
        },
        servico: {
            required: true
        }
    },
    data() {
        return {
            data_servico: this.servico,
            titulo: "",
            descricao: "",
            endereco_servico: "",
            valor: "",

        }
    },
    template: `
    <div class="edit_servico_perfil">
        <form action="url_edit_servico" method="post">
            <input type="hidden" name="servico_id" :value="data_servico.id" />
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
        this.data_servico = this.servico,
        this.titulo = this.data_servico.titulo;
        this.descricao = this.data_servico.descricao;
        this.endereco_servico = this.data_servico.enderecoServico;
        this.valor = this.data_servico.valor;
    }
}