var perfilComponent = {
    props: {
        homeurl:{
            required: true
        },
        servicos: {
            required: true
        },
        mensagens: {
            required: true
        },
        contatos: {
            required: true
        },
        avaliacoes: {
            required: true
        }
    },
    data() {
        return {
            data: [],
            datamsg: [],
            datactt: [],
            dataava: [],
        }
    },
    mounted() {
        this.data = btoa(this.servicos);
        this.datamsg = btoa(this.mensagens);
        this.datactt = btoa(this.contatos);
        this.dataava = btoa(this.avaliacoes);
    },
    template: `
        <div class="col-lg-9 p-3">
            <div class="d-flex m-0 justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <router-link to="/" class="shadow-none " :class="this.$route.path == '/' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="title-md">
                            Página inicial
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'services', query: { servicos: data, homeurl, contatos: datactt }}" class="shadow-none " :class="this.$route.path == '/services' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-briefcase    "></i>
                        <span class="title-md">
                            Meus serviços
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'messages', query: { mensagens: datamsg, contatos: datactt, homeurl }}" class="shadow-none " :class="this.$route.path == '/messages' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-envelope    "></i>
                        <span class="title-md">
                            Mensagens
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'rating', query: { avaliacoes: dataava, homeurl }}" class="shadow-none " :class="this.$route.path == '/rating' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-star    "></i>
                        <span class="title-md">
                            Avaliações
                        </span>
                    </router-link>
                    <router-link to="/configuration" class="shadow-none " :class="this.$route.path == '/configuration' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
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