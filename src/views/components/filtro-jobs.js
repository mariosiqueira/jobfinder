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
        <div class="d-flex flex-column border-right" id="vertical-navbar">
            <div class="d-flex justify-content-between align-items-center px-2">
                <span class="text-uppercase font-weight-bold">
                    <i class="fas fa-filter"></i>
                    filtro
                </span>
            </div>
            <div>
                <div class="form-group p-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <form method="get" :action="url">
                        <div class="form-group mt-5">
                            <small class="text-muted text-uppercase">Palavra-chave</small>
                            <input type="text" class="form-control" name="descricao">
                        </div>
                        <div class="form-group my-5">
                            <small class="text-muted text-uppercase">categoria</small>
                            <select name="categoria" class="form-control" required>
                                <option value="todos" selected></option>
                                <option v-for="categoria in data_categorias" :value="categoria.id">{{categoria.nome}}</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group mt-5 p-3">
                            <button class="btn btn-md btn-outline-success btn-block">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `
}