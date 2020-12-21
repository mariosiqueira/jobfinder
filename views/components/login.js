var loginComponent = {
    props: {
        action_login: {
            // required: true,
            type: String,
            default: ""
        },
        url_cadastro: {
            required: true,
            type: String
        },
        url_login: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            email: "",
            senha: "",
            emailValid: true,
            senhaValid: true,
        }
    },
    methods:{
        validadeInput(campoValid){
            console.log(campoValid);
            // if(!this.campoValid){
            //     this.campoValid = false;
            // }
            // console.log(campoValid);

        }
    },  
    template: `
    <div class="jf-container container-acesso justify-content-center">
        <div class="col-md-5 m-0 p-0 mx-auto">
            <form :action="action_login" method="post" class="mx-auto p-5 padding-md rounded shadow">
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label for="email" class="required">E-mail</label>
                        <input type="text" class="form-control" name="email" v-model="email" placeholder="usuario@email.com"
                        @blur="validadeInput('this.emailValid')"
                        :class="!email & !emailValid? ' is-invalid':''"
                        >
                        <small class="invalid-feedback">
                            Este campo é obrigatório
                        </small>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="senha" class="required">Senha</label>
                        <input type="password" name="senha" v-model="senha" class="form-control" placeholder="**********">
                        <small class="invalid-feedback">
                            Este campo é obrigatório
                        </small>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="lembrar">
                    <label class="form-check-label" for="lembrar">
                        Lembrar de mim
                    </label>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary font-weight-bold btn-md btn-primary btn-block rounded-pill" v-if="senha && email">
                        Entrar
                    </button>
                    <button type="button" class="btn btn-primary font-weight-bold btn-md btn-primary btn-block rounded-pill" v-else disabled>
                        Entrar
                    </button>
                    <a class="btn btn-md btn-light btn-block rounded-pill":href="url_cadastro">
                        Cadastre-se
                    </a>
                </div>
            </form>
        </div>
    </div>
    `
}