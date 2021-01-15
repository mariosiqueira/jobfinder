<?php 
    check_auth($routes); //faz o check se o usuario está logado
    
    $id_job = isset($_GET['s']) ? $_GET['s'] : null; //id do serviço
    if($id_job == null){ //se não for passado o id ele redeciona para a view de home, deve ser implmentado tambem para quando o id não resultar em nenhum dado do banco 
        header("location: $routes->home"); 
    }
?>

<?php require "layouts/app/head.php";
    use App\Config\Conexao;//Importa o PDO
        
    use App\Dao\UsuarioDaoMysql; 
    use App\Dao\ServicoDaoMysql; 
    use App\Dao\ServicoCategoriaDaoMysql; 
    use App\Dao\CategoriaDaoMysql; 

    $pdo = Conexao::getInstance();

    $servicoDao = new ServicoDaoMysql($pdo);
    $servico = $servicoDao->buscarPeloId($id_job);

    if (!$servico) { //verifica se retornou um serviço valido do banco
        header("location: $routes->jobs"); //se nao existir ele redericiona para jobs
    }

    // pegando o usuario a quem pertence o job
    $usuarioDaoMysql = new UsuarioDaoMysql($pdo);

    $usuario = $usuarioDaoMysql->buscarPeloId($servico->getUsuarioId());

    if($servico->getUsuarioId() == getUser()->getId()){ //verifica se o serviço retornado pertence ao usuário logado
        header("location: $routes->jobs"); //se pertecer ele redericiona para jobs
    }
    $servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);

    $categorias = new CategoriaDaoMysql($pdo);
    $servicoCategorias = $servicoCategoriaDao->buscarPeloIdDoServico($servico->getId());
?>
<div class="container-job">
    <div class="col-md-8 m-0 p-0 mx-auto rounded" style="background-color: DarkSlateGray;">
        <div class="d-flex align-items-center justify-content-between m-0 p-3">
            <div>
                <img src="<?php echo $routes->home."src/files/". $usuario->getFotoPerfil();?>" alt="img profile user" id="servico_img_user" />
                <span class="text-white"><?php echo $usuario->getApelido();?></span>
            </div>
            <small class="text-white">
                <i class="fas fa-calendar"></i>
                <?php echo $servico->getDataPostagem();?>
            </small>
        </div>
        <div class="form-group text-center mt-4">
            <h2 class="text-white">
                <?php echo "#".$servico->getTitulo()?>
            </h2>
        </div>
        <div class="my-5 p-5 paddind-md border-bottom">
            <p class="text-justify text-white font-weight-bold">
                <?php echo $servico->getDescricao()?>
            </p>
        </div>
        <p class="p-2">
            <span class="text-white">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo $servico->getEnderecoServico()?>
            </span>
            <strong class="text-white float-right">R$ <?php echo $servico->getValor()?></strong>
        </p>
        <hr>
        <p class="w-50 d-flex flex-wrap ">
            <?php foreach ($servicoCategorias as $c): ?>
                <span class="badge badge-success m-1">
                    <?php echo $categorias->buscarPeloId($c->getCategoriaId())->getNome();?>
                </span>
            <?php endforeach ?>
        </p>
        <hr>
    </div>
    <div class="col-md-8 mx-auto">
        <form action="<?php echo $routes->proposta?>" method="post" class="p-5 padding-md">
            <input type="hidden" name="contratado_id" value="<?php echo $servico->getUsuarioId()?>">
            <input type="hidden" name="contratante_id" value="<?php echo getUser()->getId()?>">
            <div class="form-row">
                <div class="col-md-12 mx-auto form-group">
                    <small class="text-muted text-uppercase">Faça sua proposta: </small>
                    <textarea class="form-control" name="mensagem" rows="3"
                        style="background-color:lightgrey">Tenho interesse no serviço</textarea>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-dark">
                    Enviar
                    <i class="fas fa-arrow-circle-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php require "layouts/app/footer.php"?>