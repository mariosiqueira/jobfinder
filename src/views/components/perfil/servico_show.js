var servicoShow = {
    props: {
        url_get_servico: {
            type: String,
        },
        servico: {
            required: true
        },
        categorias: {
            required: true
        }
    },
    data() {
        return {
            data_servico: [],
            data_categorias: [],
            categorias_servico: [],
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
                <div class="col-md-12 form-group">
                    <label for="c" class="required">Categoria</label>
                    <select multiple class="form-control" name="categoria[]" id="c" required>
                        <option v-for="categoria in data_categorias" 
                            :value="categoria.id" :selected="categorias_servico.find(e => e.id == categoria.id) != undefined">
                                {{categoria.nome}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-5" style="margin-bottom: 150px">
                <button type="submit" class="btn btn-success btn-md btn-block rounded-pill" id="btn_editar_servico">
                    Salvar
                </button>
            </div>
        </form>
    </div>
    `,
    mounted() {
      
        var aux = JSON.parse(this.servico);
        this.data_servico = aux.servico;
        this.data_categorias = JSON.parse(atob(this.categorias));
        this.categorias_servico = aux.categorias;
        this.titulo = this.data_servico.titulo;
        this.descricao = this.data_servico.descricao;
        this.endereco_servico = this.data_servico.enderecoServico;
        this.valor = this.data_servico.valor;
    }
}