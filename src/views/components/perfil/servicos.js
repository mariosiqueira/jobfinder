var JobComponent = {
    props: {
        contatos: {
            required: true,
        },
        homeurl: {
            required: true,
        },
        servicos: {
            required: true,
        },
        categorias: {
            required: true,
        }
    },
    data() {
        return {
            data_servicos: [],
            servico: "",
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
        this.condicao = this.data_servicos_filtro.length == 0 ? true : false;
        this.servico = btoa(this.servicos);
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
                    <button type="button" class="btn btn-sm btn-primary shadow-none rounded-pill d-flex m-0 ml-1 align-items-center" @click="filtrarDados()">
                        <i class="fas fa-filter    "></i>
                        <span class="ml-1">
                            Filtrar
                        </span>
                    </button>
                </div>
                <button class="btn btn-primary text-uppercase shadow-none" data-toggle="modal" data-target="#adicionar_servico" id="perfil_servicos_btn_add_servico">
                    <i class="fas fa-plus    "></i>
                    <span class="title-md">
                        Novo
                    </span>
                </button>
            </div>
            <div v-if="this.condicao" class="alert alert-warning mt-5" role="alert">
                <p class="p-1 m-0">
                    <i class="fas fa-info-circle    "></i>
                    Nenhum serviço encontrado</p>
            </div>
            <li v-else v-for="data in data_servicos_filtro" :key="data.servico.id" :class="data.servico.status=='finalizado' ? 'bg-grey text-white':'bg-success text-white'">
                <p class="d-flex justify-content-between">
                    <span>
                        <span class="badge badge-light mr-2" v-if="data.servico.status == 'aberto'">Aberto</span>
                        <span class="badge badge-danger mr-2" v-else>Finalizado</span>
                        <strong>{{data.servico.titulo}}</strong><br>
                    </span>
                    <router-link :to="{name: 'services_close', params: {id: data.servico.id}, query: { homeurl, contatos } }" class="btn btn-sm btn-danger" v-if="data.servico.status=='aberto'">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                        Finalizar
                    </router-link>
                </p>
                <hr>    
                {{data.servico.descricao}}
                <div class="d-flex m-0 justify-content-between mt-5">
                    <strong class="text-white">{{data.servico.valor}}</strong><br>
                    <div class="d-flex m-0">   
                        <form :action="homeurl+'services/delete'" :id="data.servico.id" method="post">
                            <input type="hidden" name="id" :value="data.servico.id" />
                            <button class="btn btn-danger btn-sm" type="button" :id="'deletar'+data.servico.id" @click="deletarServico(data.servico.id)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                        <router-link :id="'editar'+data.servico.id" class="btn btn-primary btn-sm ml-1" :to="{name: 'services_show', query: {servico: JSON.stringify(data), categorias} }" v-if="data.servico.status != 'finalizado'">
                            <i class="fas fa-eye"></i>
                        </router-link>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    `,
    methods: {

        //Método invocado pelo botão de apagar serviço. Para acessar o arquivo action_delete_servico.php utilizei axios para fazer essa requisião assíncrona.
        deletarServico(id) {

            var op = confirm("Tem certeza que deseja apagar este serviço?");

            if (op == true) {
                $(`form#${id}`).submit();
            }
        },
        filtrarDados() {
            this.data_servicos_filtro = [];
            if (this.filtro == 'todos') {
                this.data_servicos_filtro = this.data_servicos;
            } else {
                this.data_servicos.forEach(e => {
                    if (e.servico.status == this.filtro) {
                        this.data_servicos_filtro.push(e);
                    }
                });
            }
            this.condicao = this.data_servicos_filtro.length == 0 ? true : false;
        }
    }
}