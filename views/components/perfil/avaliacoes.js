var AvaliacoesComponent = {
    props: {
        homeurl: {
            required: true
        },
        avaliacoes: {
            required: true
        }
    },
    data() {
        return {
            data_avaliacao: Object
        }
    },
    template: `
    <div>
        <div class="avaliacoes-container">
            <div v-if="data_avaliacao.length == 0">
                <div class="alert alert-warning" role="alert">
                    <p class="m-0 p-1">
                        <i class="fas fa-info-circle    "></i>
                        Você ainda não tem nenhuma avaliação
                        <i class="fas fa-smile-beam    "></i>
                    </p>
                </div>
                <p class="p-1">
                    Comece a fazer serviços e receba avaliações dos usuários
                    <a  class="text-uppercase" :href="homeurl + 'jobs'">Começar</a>
                </p>
            </div>
            <div class="form-row mb-2 p-3 padding-md rounded" v-else v-for="ava in data_avaliacao" style="background-color:DarkSlateGray">
                <p class="text-left text-white ml-2">
                    <img :src="homeurl +'files/'+ ava.avaliador_id.fotoPerfil" style="width: 40px; height:40px; border-radius: 50%" />
                    <span>{{ava.avaliador_id.apelido}}</span>
                </p>
                <div class="col-md-12">
                    <textarea class="form-control" name="comentario" rows="3" disabled>{{ava.comentario}}</textarea>
                </div>            
                <div class="text-right ml-auto mr-1 p-2" :title="ava.avaliacao">
                    <i class="fas fa-star" v-for="i in (0, 5)" :class="i <= ava.avaliacao ? ' text-warning' : ' text-light'"></i>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
        this.data_avaliacao = JSON.parse(atob(this.avaliacoes));
    }
}