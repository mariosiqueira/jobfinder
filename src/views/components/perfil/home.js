var HomeComponent = {

    template: `
    <div>
        <h1 class="text-muted text-uppercase">Olá, {{user.apelido}}.</h1>
        <div class="my-5">
            <ul class="list-group">
                <li class="list-group-item list-group-item-success mr-4">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    {{user.nome}}
                </li>
                <li class="list-group-item list-group-item-success mr-4">
                    <i class="fas fa-envelope    "></i>
                    {{user.email}}
                </li>
                <li class="list-group-item list-group-item-success mr-4">
                    <i class="fas fa-phone    "></i>
                    {{user.telefone}}
                </li>
            </ul>
        </div>
    </div>
    `,
    data() {
        return {
            user: user //variável declarada no script do footer do layout app
        }
    },
    methods: {
        modo_noturno() {
            alert('Indisponível');
        },
    },
}