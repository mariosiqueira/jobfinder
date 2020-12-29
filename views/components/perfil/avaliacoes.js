var AvaliacoesComponent = {
    props: {
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
            <div class="form-row mb-2 p-3 padding-md rounded" v-for="ava in data_avaliacao" style="background-color:DarkSlateGray">
                <p class="text-left text-white ml-2">
                    <img :src="ava.usuario.foto_perfil" style="width: 50px; border-radius: 50%" />
                    <span>{{ava.usuario.apelido}}</span>
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