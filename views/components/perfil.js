var perfilComponent = {
    props: {
        servicos: {
            required: true
        },
        mensagens:{
            required: true
        }
    },
    data() {
        return {
            data: [],
            datamsg: []
        }
    },
    mounted() {
        this.data = btoa(this.servicos);
        this.datamsg = btoa(this.mensagens);
    },
    template: `
        <div class="col-lg-9 p-3">
            <div class="d-flex m-0 justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <router-link to="/" class="btn btn-outline-dark">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="title-md">
                            Página inicial
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'services', query: { servicos: data }}" class="btn btn-outline-dark">
                        <i class="fas fa-star    "></i>
                        <span class="title-md">
                            Meus serviços
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'messages', query: { mensagens: datamsg }}" class="btn btn-outline-dark">
                        <i class="fas fa-envelope    "></i>
                        <span class="title-md">
                            Mensagens
                        </span>
                    </router-link>
                    <router-link to="/configuration" class="btn btn-outline-dark">
                        <i class="fas fa-cog    "></i>
                        <span class="title-md">
                            Configurações
                        </span>
                    </router-link>
                </div>
            </div>
            <div class="pt-5 mx-2" id="list-services-profile">
                <router-view></router-view>
            </div>
        </div>
    `
}