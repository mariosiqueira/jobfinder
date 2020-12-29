var JobComponent = {
    props: {
        servicos: {
            required: true,
        }
    },
    data() {
        return {
            data_servicos: [],
            data_servicos_filtro: [],
            condicao: {
                type: Boolean
            },
            filtro: "todos"
        }
    },
    mounted() {
        this.data_servicos = JSON.parse(atob(this.servicos));
        this.data_servicos_filtro = this.data_servicos;
        this.condicao = this.data_servicos.length <= 0 ? true : false
    },
    template: `
    <div>
        <ul class="profile-list-service">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div class="d-flex align-items-center m-0 p-0">
                    <select class="form-control shadow-none m-0" v-model="filtro">
                        <option value="todos" selected>Todos</option>
                        <option value="aberto">Abertos</option>
                        <option value="finalizado">Finalizados</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-primary rounded-pill d-flex m-0 ml-1 align-items-center" @click="filtrarDados()">
                        <i class="fas fa-filter    "></i>
                        <span class="ml-1">
                            Filtrar
                        </span>
                    </button>
                </div>
                <button class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#adicionar_servico">
                    <i class="fas fa-plus    "></i>
                    <span class="title-md">
                        Novo
                    </span>
                </button>
            </div>
            <div v-if="this.condicao" class="alert alert-warning" role="alert">
                <p class="p-1 m-0">Nenhum serviço encontrado</p>
            </div>
            <li v-else v-for="servico in data_servicos_filtro" :key="servico.id" :class="servico.status=='finalizado' ? 'bg-grey text-white':'bg-success text-white'">
                <p class="d-flex justify-content-between">
                    <span>
                        <span class="badge badge-light mr-2" v-if="servico.status == 'aberto'">Aberto</span>
                        <span class="badge badge-danger mr-2" v-else>Finalizado</span>
                        <strong>{{servico.titulo}}</strong><br>
                    </span>
                    <router-link :to="{name: 'services_close', params: {id: servico.id} }" class="btn btn-sm btn-danger" v-if="servico.status=='aberto'">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                        Finalizar
                    </router-link>
                </p>
                <hr>    
                {{servico.descricao}}
                <div class="d-flex m-0 justify-content-between mt-5">
                    <strong class="text-white">{{servico.valor}}</strong><br>
                    <div class="d-flex m-0">                
                        <button class="btn btn-danger btn-sm" @click="deletarServico(servico.id)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <router-link class="btn btn-primary btn-sm ml-1" :to="{name: 'services_show', params: {id: servico.id} }" v-if="servico.status != 'finalizado'">
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
        },
        filtrarDados() {
            this.data_servicos_filtro = [];
            if (this.filtro == 'todos') {
                this.data_servicos_filtro = this.data_servicos;
            } else {
                this.data_servicos.forEach(e => {
                    if (e.status == this.filtro) {
                        this.data_servicos_filtro.push(e);
                    }
                });
            }
        }
    }
}