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
                <div class="col-md-3 shadow rounded m-1 mb-5 pt-2 px-1 pb-0" v-for="servico in data" :key="servico.id">
                    <p class="p-3">
                        <img src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg" alt="img profile user" id="servico_img_user" />
                        <span>username</span>
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        <strong class="text-uppercase">{{servico.titulo}}</strong>
                    </p>
                    <p>
                        {{servico.descricao.substr(0, 40)+"..."}} <a :href="show_job +'?s='+ servico.id">ver mais</a>
                    </p>
                    <p class="mt-5">
                        <a :href="show_job +'?s='+ servico.id" class="btn btn-primary btn-block d-flex align-items-center justify-content-center m-0 p-0">
                        <strong>
                            Faça uma proposta
                        </strong>
                        <i class="fas fa-arrow-circle-right mt-1 ml-1"></i>
                        </a>
                    </p>
                </div>
            </div>

        </div>
    `
}