var ConfigComponent = {

    template: `
    <div>
        <h1 class="text-muted text-uppercase">Configurações</h1>
        <div class="my-4"></div>

        <ul class="list-group">
            <li class="list-group-item list-group-item-success mr-4">
                <button class="btn btn-link" data-toggle="modal" data-target="#alterar_apelido">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Alterar apelido
                </button>
            </li>
            <li class="list-group-item list-group-item-success mr-4">
                <button class="btn btn-link" v-on:click="modo_noturno()">
                    <i class="fas fa-moon    "></i>
                    Modo noturno
                </button>
            </li>
            <li class="list-group-item list-group-item-success mr-4">
                <button class="btn btn-link">
                    <i class="fas fa-bug    "></i>
                    Relatar um problema
                </button>
            </li>
            <li class="list-group-item list-group-item-success mr-4">
                <button class="btn btn-link">
                    <i class="fas fa-file-alt    "></i>
                    Termos e responsabilidade
                </button>
            </li>
            <li class="list-group-item list-group-item-danger text-right mr-4">
                <button class="btn btn-link">
                    <i class="fas fa-trash    "></i>
                    Deletar minha conta
                </button>
            </li>
        </ul>
    </div>
    `,
    methods: {
        modo_noturno() {
            alert('Indisponível');
        }
    }
}