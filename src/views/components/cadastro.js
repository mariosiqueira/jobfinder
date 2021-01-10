var cadastroComponent = {
    props: {
        action_cadastro: {
            required: true,
            type: String,
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
            nome: "",
            telefone: "",
            email: "",
            senha: "",
            confirmSenha: "",
            nomeValid: true,
            telefoneValid: true,
            emailValid: true,
            senhaValid: true,
            confirmSenhaValid: true,
            errorSenhaMsg: "Este campo é obrigatório"
        }
    },
    methods: {
        validarNome() {
            if (!this.nome) {
                this.nomeValid = false;
            }
        },
        validarTelefone() {
            var telefone = $("#telefone").val()
            if (telefone == "") {
                this.telefoneValid = false;
            } else {
                this.telefone = telefone
            }
        },
        validarEmail() {
            if (!this.email) {
                this.emailValid = false;
            }
        },
        validarSenha() {
            if (!this.senha) {
                this.senhaValid = false;
            }
        },
        validarConfirmSenha() {
            if (!this.confirmSenha) {
                this.confirmSenhaValid = false;
            }
        },
        formCadastro() {
            if (this.senha !== this.confirmSenha) {
                this.senha = "";
                this.senhaValid = false;
                this.confirmSenha = "";
                this.confirmSenhaValid = false;
                this.errorSenhaMsg = "As senhas são diferentes!"
            } else {
                $('#cadastro').submit();
            }
        },
    },
    template: `
    <div class="jf-container container-acesso justify-content-center" style="margin-top: 100px;">
        <div class="col-md-5 m-0 p-0 mx-auto">
            <form @submit.prevent="formCadastro()" id="cadastro" :action="action_cadastro" method="post" class="p-5 padding-md rounded shadow">
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label for="nome" class="required">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" v-model="nome"
                        @blur="validarNome()" :class="!nome && !nomeValid ? ' is-invalid':''"
                        >
                        <small class="invalid-feedback">
                            Este campo é obrigatório
                        </small>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="telefone" class="required">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" v-model="telefone"
                        @blur="validarTelefone()" :class="!telefone && !telefoneValid ? ' is-invalid':''" 
                        >
                        <small class="invalid-feedback">
                            Este campo é obrigatório
                        </small>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="email" class="required">E-mail</label>
                        <input type="text" class="form-control" placeholder="usuario@email.com" id="email" name="email" v-model="email"
                        @blur="validarEmail()" :class="!email & !emailValid ? ' is-invalid':''"
                        >
                        <small class="invalid-feedback">
                            Este campo é obrigatório
                        </small>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="senha" class="required">Senha</label>
                        <input type="password" class="form-control" placeholder="**********" name="senha" id="senha" v-model="senha"
                        @blur="validarSenha()" :class="!senha & !senhaValid ? ' is-invalid':''"
                        >
                        <small class="invalid-feedback">
                            {{errorSenhaMsg}}
                        </small>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="senha" class="required">Confirmar senha</label>
                        <input type="password" class="form-control" placeholder="**********" id="confirmSenha" name="confirmSenha" v-model="confirmSenha"
                        @blur="validarConfirmSenha()" :class="!confirmSenha & !confirmSenhaValid ? ' is-invalid':''"
                        >
                        <small class="invalid-feedback">
                            {{errorSenhaMsg}}
                        </small>
                    </div>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-md btn-primary font-weight-bold btn-block rounded-pill" v-if="nome && email && telefone && senha && confirmSenha">
                        Cadastrar
                    </button>
                    <button type="button" class="btn btn-md btn-primary font-weight-bold btn-block rounded-pill" v-else disabled>
                        Cadastrar
                    </button>
                </div>
                <div class="text-right">
                    <span>já é cadastrado?</span>
                    <a :href="url_login">fazer login</a>
                </div>
            </form>
        </div>
    </div>
    `
}