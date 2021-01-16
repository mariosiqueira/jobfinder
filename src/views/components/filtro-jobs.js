var filtroJobsComponent = {
    props:{
        categorias: {
            required: true
        },
        url: {
            required: true
        }
    },
    data(){
        return {
            data_categorias: []
        }
    },
    mounted(){
        this.data_categorias = JSON.parse(this.categorias);
    },
    template: `
        <div class="d-flex flex-column border-right p-2" id="vertical-navbar" style="margin-top: 50px">
            <div class="d-flex justify-content-between align-items-center px-2 mb-3 mt-5">
                <span class="text-uppercase font-weight-bold text-center mx-auto">
                    <i class="fas fa-filter"></i>
                    filtro
                </span>
            </div>
            <div>
                <div class="form-group">
                    <form method="get" :action="url">
                        <div class="form-group">
                            <small class="text-uppercase">Palavra-chave</small>
                            <input type="text" class="form-control" name="descricao">
                        </div>
                        <div class="form-group">
                            <small class="text-uppercase text-left">categoria</small>
                            <select name="categoria" class="form-control" required>
                                <option value="todos" selected></option>
                                <option v-for="categoria in data_categorias" :value="categoria.id">{{categoria.nome}}</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group mt-5 p-3">
                            <button class="btn btn-md btn-outline-light btn-block" id="btn_filtrar_jobs">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `
}