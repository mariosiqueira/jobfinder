<?php
    check_auth($routes); //faz o check se o usuario está logado

    // dados fake pra teste
    $data = [
        [
            "id"=>1,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>2,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>3,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>4,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>5,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>6,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>7,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>8,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>9,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>10,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
    ];
    $datactt = [
        [
            "id"=>1,
            "nome"=> "username",
            "foto_perfil"=>"https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg",
        ],
        [
            "id"=>2,
            "nome"=> "username",
            "foto_perfil"=>"https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg",
        ],
        [
            "id"=>3,
            "nome"=> "username",
            "foto_perfil"=>"https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg",
        ],
        [
            "id"=>4,
            "nome"=> "username",
            "foto_perfil"=>"https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg",
        ],
        [
            "id"=>5,
            "nome"=> "username",
            "foto_perfil"=>"https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg",
        ]
    ];
    $datamsg = [
        [
            "id"=>1,
            "to"=>1,
            "from"=>2,
            "mensagem"=>"olá"
        ],
        [
            "id"=>2,
            "to"=>2,
            "from"=>1,
            "mensagem"=>"olá tudo bem?"
        ],
        [
            "id"=>3,
            "to"=>1,
            "from"=>3,
            "mensagem"=>"olá tudo bem?"
        ],
        [
            "id"=>4,
            "to"=>3,
            "from"=>1,
            "mensagem"=>"olá tudo bem? olá tudo bem? olá tudo bem? olá tudo bem? olá tudo bem? olá tudo bem?"
        ],
        [
            "id"=>5,
            "to"=>1,
            "from"=>3,
            "mensagem"=>"olá tudo bem?"
        ],
        [
            "id"=>6,
            "to"=>3,
            "from"=>1,
            "mensagem"=>"olá tudo bem?"
        ],
    ]

?>
<?php require "layouts/app/head.php"?>
<div class="row m-0 container-perfil">
    <perfil-descricao-component
        ation_profile_img="url_aqui"
        avaliacao_usuario="3"
    ></perfil-descricao-component>
    <perfil-component 
        servicos='<?php echo json_encode($data);?>' 
        mensagens='<?php echo json_encode($datamsg);?>' 
        contatos='<?php echo json_encode($datactt);?>'
    >
    </perfil-component>
</div>

<!-- Modal alterar apelido -->
<div class="modal fade" id="alterar_apelido" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="col-md-12 form-group">
                        <label for="apelido" class="required">Apelido</label>
                        <input type="text" name="apelido" id="apelido" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md btn-block rounded-pill">
                            Alterar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal adicionar servico -->
<div class="modal fade" id="adicionar_servico" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Titulo</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Descricao</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Endereço</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor">
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success btn-md btn-block rounded-pill">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "layouts/app/footer.php"?>