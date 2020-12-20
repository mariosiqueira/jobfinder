var HomeComponent = {

    template: `
    <div>
        <h1 class="text-muted text-uppercase">Olá, {{username}}.</h1>
        <div class="my-4"></div>
    </div>
    `,
    data() {
        return {
            username: "username"
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