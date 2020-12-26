var listJobsComponent = {
    props: {
        servicos: {
            required: true,
        },
        show_job: {
            required: true,
            type: String,
        }
    },
    data() {
        return {
            data: []
        }
    },
    mounted() {
        this.data = JSON.parse(this.servicos);
    },
    template: `
        <div class="d-flex flex-column p-3" id="job-list">
            <div class="row justify-content-center m-0">
                <div class="col-md-4 shadow rounded m-1 mb-5 pt-2 px-1 pb-0" v-for="servico in data" :key="servico.id"  style="background-color: DarkSlateGray;">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="p-3">
                            <img src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg" alt="img profile user" id="servico_img_user" />
                            <span class="text-white">username</span>
                        </p>
                        <a :href="show_job +'?s='+ servico.id" class="btn btn-success mb-4">
                            <strong>
                                Proposta
                                <i class="fas fa-plus-circle    "></i>
                            </strong>
                        </a>
                    </div>
                    <div class="form-group text-center text-white">
                        <strong class="text-uppercase"># {{servico.titulo}}</strong>
                    </div>
                    <p class="text-center border text-white p-5 padding-md">
                        {{servico.descricao.substr(0, 100)+"..."}} <a :href="show_job +'?s='+ servico.id">ver mais</a>
                    </p>
                    <p class="d-flex flex-wrap m-1">
                        <span v-for="i in (0, 3)" :key="i" class="badge badge-pill badge-light m-1">categoria {{i}}</span>
                    </p>
                </div>
            </div>

        </div>
    `
}