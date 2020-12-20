var HomeComponent = {

    template: `
    <div>
        <h1 class="text-muted text-uppercase">Olá, {{user.apelido}}.</h1>
        <div class="my-4"></div>
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
    mounted() {
    }
}