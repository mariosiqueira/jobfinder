var ConfigComponent = {

    template: `
    <div class="mt-5">
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
                <button class="btn btn-link" data-toggle="modal" data-target="#editar_conta">
                    <i class="fas fa-edit    "></i>
                    Editar meus dados
                </button>
            </li>
            <li class="list-group-item list-group-item-success mr-4">
                <button class="btn btn-link" data-toggle="modal" data-target="#termos_e_responsabilidade">
                    <i class="fas fa-file-alt    "></i>
                    Termos e responsabilidade
                </button>
            </li>
            <li class="list-group-item list-group-item-danger text-right mr-4">
                <button class="btn btn-link" data-toggle="modal" data-target="#deletar_conta">
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