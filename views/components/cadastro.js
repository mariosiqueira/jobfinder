var cadastroComponent = {
    props: {
        action_cadastro: {
            required: true,
            type: String,
            // default: ""
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
    <div class="jf-container container-acesso justify-content-center" style="margin-top: 100px;">
        <div class="col-md-5 m-0 p-0 mx-auto">
            <form :action="action_cadastro" method="post" class="p-5 padding-md rounded" style="background-color: lightgrey">
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label for="nome" class="required">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="telefone" class="required">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="email" class="required">E-mail</label>
                        <input type="text" class="form-control" placeholder="usuario@email.com" name="email">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="senha" class="required">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="**********">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="contra-senha" class="required">Confirmar senha</label>
                        <input type="password" name="contra-senha" id="contra-senha" class="form-control" placeholder="**********" >
                    </div>
                </div>
                <div class="form-group mt-5">
                    <input class="btn btn-md btn-light btn-block rounded-pill" type="submit" value="Cadastrar">
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