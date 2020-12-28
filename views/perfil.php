<?php
    check_auth($routes); //faz o check se o usuario está logado 

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

<?php 
require "layouts/app/head.php";
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/CategoriaDaoMysql.php'; //import da classe CategoriaDaoMysql pra buscar as categorias do banco de dados e mostrar na aplicação na hora de criar um novo serviço
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoDaoMysql.php'; //Import da classe ServicoDaoMysql para recuperar os serviços cadastrados pelo usuário da sessão e que serão exibidos no perfil dele

//Recuperando as categorias cadastradas no banco de dados para exibir no modal de cadastro de serviço
$categoriaDao = new CategoriaDaoMysql($pdo);
$categorias = [];
$arrayDadosObjetosCategorias = $categoriaDao->buscarTodas();
foreach($arrayDadosObjetosCategorias as $dadoObjetoCategoria) {
    $novaCategoria = new Categoria();
    $novaCategoria->setId($dadoObjetoCategoria->getId());
    $novaCategoria->setNome($dadoObjetoCategoria->getNome());
    $categorias [] = $novaCategoria;
}

//Recuperando os serviços cadastrados pelo usuário da sessão
$usuarioSessao = unserialize($_SESSION['auth']);
$servicoDao = new ServicoDaoMysql($pdo);
$data = [];

$arrayDadosObjetosServico = $servicoDao->buscarServicoPeloIdDoUsuario($usuarioSessao->getId());
if($arrayDadosObjetosServico != null) {
    
    foreach($arrayDadosObjetosServico as $dadoObjetoServico) {
        $novoServico = new Servico();
        $novoServico->setId($dadoObjetoServico->getId());
        $novoServico->setTitulo($dadoObjetoServico->getTitulo());
        $novoServico->setDescricao($dadoObjetoServico->getDescricao());
        $novoServico->setEnderecoServico($dadoObjetoServico->getEnderecoServico());
        $novoServico->setValor($dadoObjetoServico->getValor());
        $novoServico->setUsuarioId($_SESSION['auth']);
        $novoServico->setDataPostagem($dadoObjetoServico->getDataPostagem());
        $data [] = $novoServico;
    }
}

?>

<div class="row m-0 container-perfil">
    <perfil-descricao-component
        ation_profile_img="controller/usuario_imagem.php"
        avaliacao_usuario="3"
        url='<?php echo $routes->home;?>' 
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
                <form action="../jobfinder/controller/alterar_apelido.php" method="post">
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
<div class="modal fade" id="adicionar_servico" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../jobfinder/controller/action_cadastrar_servico_e_servico_categoria.php" method="post">
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Titulo</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Descricao</label>
                            <input type="text" class="form-control" name="descricao" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Endereço</label>
                            <input type="text" class="form-control" name="endereco_servico">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="categorias" class="required">Categoria</label>
                            <select multiple class="form-control" name="categoria[]" id="categorias" required>
                                <?php foreach($categorias as $categoria): forea?>
                                <option><?php echo $categoria->getNome()?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success btn-md btn-block rounded-pill">
                            Cadastrar
                        </button>
                    </div>
                    <input type="hidden" name="usuario_id" value=<?= $usuarioSessao->getId() ?>>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "layouts/app/footer.php"?>