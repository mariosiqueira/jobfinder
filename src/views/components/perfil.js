var perfilComponent = {
    props: {
        homeurl:{
            required: true
        },
        categorias: {
            required: true
        },
        avaliacoes: {
            required: true
        }
    },
    data() {
        return {
            data: [],
            dataava: [],
            data_categorias: []
        }
    },
    mounted() {
        this.data_categorias = btoa(this.categorias);
        this.data = btoa(this.servicos);
        this.dataava = btoa(this.avaliacoes);
    },
    template: `
        <div class="col-lg-9 p-3">
            <div class="d-flex m-0 justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <router-link id="perfil_inicio" to="/" class="shadow-none " :class="this.$route.path == '/' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="title-md">
                            Página inicial
                        </span>
                    </router-link>
                    <router-link id="perfil_servicos" :to="{ name: 'services', query: { categorias: data_categorias, homeurl }}" class="shadow-none " :class="this.$route.path == '/services' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-briefcase    "></i>
                        <span class="title-md">
                            Meus serviços
                        </span>
                    </router-link>
                    <router-link id="perfil_mensagens" :to="{ name: 'messages', query: { homeurl }}" class="shadow-none " :class="this.$route.path == '/messages' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-envelope    "></i>
                        <span class="title-md">
                            Mensagens
                        </span>
                    </router-link>
                    <router-link id="perfil_avaliacoes" :to="{ name: 'rating', query: { avaliacoes: dataava, homeurl }}" class="shadow-none " :class="this.$route.path == '/rating' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
                        <i class="fas fa-star    "></i>
                        <span class="title-md">
                            Avaliações
                        </span>
                    </router-link>
                    <router-link id="perfil_configuracoes" to="/configuration" class="shadow-none " :class="this.$route.path == '/configuration' ? 'btn btn-outline-dark active': 'btn btn-outline-dark'">
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