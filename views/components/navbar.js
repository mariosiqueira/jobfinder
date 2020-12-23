var navbarComponent = {
    props: {
        homeurl: {
            required: true,
            type: String
        },
        logomarca: {
            required: true,
            type: String
        },
        login: {
            required: true,
            type: String
        },
        auth: {
            required: true,
        },
        perfilurl: {
            required: true,
            type: String
        },
        mensagens: {
            required: true,
            type: String
        }
    },
    template: `
        <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top" id="navbar">
            <a class="navbar-brand" :href="homeurl">
                <img id="logomarca" :src="logomarca" alt="logomarca" />
                <strong>JobFinder</strong>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mr-5 mt-2 mt-lg-0">
                    <li class="nav-item active" v-if="auth == 'false'">
                        <a class="btn btn-outline-light text-uppercase font-weight-bold" :href="login">
                            acesso
                            <i class="fas fa-lock    "></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown" v-else>
                        <a class="btn btn-outline-light text-uppercase font-weight-bold dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>    
                            conta
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" :href="perfilurl">Perfil</a>
                            <form action="logouturl" method="post">
                                <button class="dropdown-item">Sair</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    `,
}