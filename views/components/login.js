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
    template: `
    <div class="jf-container container-acesso justify-content-center">
        <div class="col-md-5 m-0 p-0 mx-auto">
            <form :action="action_login" method="post" class="mx-auto p-5 padding-md rounded" style="background-color: lightgrey">
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label for="email" class="required">E-mail</label>
                        <input type="text" class="form-control" placeholder="usuario@email.com">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="senha" class="required">Senha</label>
                        <input type="password" class="form-control" placeholder="**********">
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="lembrar">
                    <label class="form-check-label" for="lembrar">
                        Lembrar de mim
                    </label>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-md btn-primary btn-block rounded-pill">Entrar</button>
                    <a class="btn btn-md btn-light btn-block rounded-pill"
                        :href="url_cadastro">Cadastrar-se</a>
                </div>
            </form>
        </div>
    </div>
    `
}