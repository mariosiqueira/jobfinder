var filtroJobsComponent = {
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
                    <small class="text-muted text-uppercase">categoria</small>
                    <select name="" id="" class="form-control">
                        <option>categoria1</option>
                        <option>categoria1</option>
                        <option>categoria1</option>
                        <option>categoria1</option>
                        <option>categoria1</option>
                    </select>
                    <hr>
                    <div class="d-inline">
                        <small class="text-muted text-uppercase">data inicio</small>
                        <input type="date" class="form-control">
                        
                        <small class="text-muted text-uppercase">data fim</small>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="form-group mt-5 p-3">
                    <button class="btn btn-md btn-outline-success btn-block">
                        Filtrar
                    </button>
                </div>
            </div>
        </div>
    `
}