var JobComponent = {
    props: {
        servicos: {
            required: true,
        }
    },
    data() {
        return {
            data_servicos: [],
            condicao: {
                type: Boolean
            }
        }
    },
    mounted() {
        this.data_servicos = JSON.parse(atob(this.servicos));
        this.condicao = this.data_servicos.length <= 0 ? true : false
    },
    template: `
    <div>
        <div class="form-group my-3">
            <h1 class="text-muted text-uppercase">Meus serviços</h1>
        </div>
        <ul class="profile-list-service">
            <div class="text-right">
                <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#adicionar_servico">
                    <i class="fas fa-plus    "></i>
                    Adicionar novo
                </button>
            </div>
            <div v-if="this.condicao" class="alert alert-warning" role="alert">
                <p class="p-1 m-0">Nenhum serviço encontrado</p>
            </div>
            <li v-else v-for="servico in data_servicos" :key="servico.id">
                <strong>{{servico.titulo}}</strong><br>
                <hr>    
                {{servico.descricao}}
                <div class="d-flex m-0 justify-content-between mt-5">
                    <strong class="text-danger">{{servico.valor}}</strong><br>
                    <div class="d-flex m-0">                
                        <button class="btn btn-danger btn-sm" @click="deletarServico(servico.id)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <router-link class="btn btn-success btn-sm mx-1" :to="{name: 'services_show', params: {id: servico.id} }">
                                <i class="fas fa-edit    "></i>
                        </router-link>
                        <router-link class="btn btn-warning btn-sm" :to="{name: 'services_show', params: {id: servico.id} }">
                            <i class="fas fa-eye"></i>
                        </router-link>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    `,
    methods: {
        click_servico(id) {
            alert(id)
            $(`input[id='${id}']`).attr('checked', true)
        }
    }
}