var listJobsComponent = {
    props: {
        servicos: {
            required: true,
        },
        show_job: {
            required: true,
            type: String,
        },
        home: {
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
        console.log(this.data.length);
    },
    template: `
        <div class="d-flex flex-column p-3" id="job-list">
            <div v-if="data.length == 0" class="row justify-content-center m-0">
                <div class="col-md-6">
                    <div class="alert alert-warning" role="alert">
                        <p class="m-0 p-1">
                            <i class="fas fa-info-circle"></i>
                            Nenhum serviço encontrado
                        </p>
                    </div>
                </div>
            </div>
            <div v-else class="row justify-content-center m-0">
                <div class="col-md-8">
                    <h2 class="text-muted text-center text-uppercase mb-5" style="font-size: max(2.5vw, 12pt)">
                        Encontre o <u><strong>JOB</strong></u> ideal para você
                    </h2>
                </div>
                <div class="col-md-4 shadow rounded m-1 mb-5 pt-2 px-1 pb-0" v-for="(servico, i) in data" :key="servico.id"  style="background-color: DarkSlateGray;">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="p-3">
                        <img :src="home+'/src/files/'+servico.servicos.usuarioId.fotoPerfil" alt="img profile user" id="servico_img_user" />
                        <span class="text-white">{{servico.servicos.usuarioId.apelido}}</span>
                    </p>
                    <a :href="show_job +'?s='+ servico.servicos.id" class="btn btn-success mb-4" 
                        :id="'proposta'+servico.servicos.id">
                        <strong>
                            Proposta
                            <i class="fas fa-plus-circle    "></i>
                        </strong>
                    </a>
                </div>
                <div class="form-group text-center text-white">
                    <strong class="text-uppercase"># {{servico.servicos.titulo}}</strong>
                </div>
                <p class="text-center border text-white p-5 padding-md">
                    {{servico.servicos.descricao.substr(0, 100)+"..."}} <a :href="show_job +'?s='+ servico.servicos.id">ver mais</a>
                </p>
                <hr>
                <p class="w-100 d-flex flex-wrap ">
                    <span class="badge badge-success m-1" v-for="c in data[i].categorias">
                        {{c.nome}}
                    </span>
                </p>
                </div>
            </div>

        </div>
    `
}