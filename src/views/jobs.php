
<?php require "layouts/app/head.php";
    use App\Config\Conexao; 
    use App\Dao\ServicoDaoMysql; 
    use App\Dao\ServicoCategoriaDaoMysql; 
    use App\Dao\UsuarioDaoMysql; 
    use App\Dao\CategoriaDaoMysql; 

    use App\VO\Servico;
    use App\VO\Categoria;

    $pdo = Conexao::getInstance();

    $usuarioDao = new UsuarioDaoMysql($pdo);
    $servicoDao = new ServicoDaoMysql($pdo);
    $servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);
    $servicos = [];
    
    function buscarServicos($usuarioDao, $servicoDao, $servicoCategoriaDao, $todos = false)
    {
        $servicos = [];

        $filtro = (Object) array();
        $filtro->categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
        $filtro->descricao = isset($_GET['descricao']) ? $_GET['descricao'] : '';

        $arrayDadosObjetosServico = $todos ? $servicoDao->filtrarTodosAbertos($filtro) : $servicoDao->buscarTodosAbertos();

        if($arrayDadosObjetosServico != null) {
            
            foreach($arrayDadosObjetosServico as $dadoObjetoServico) {
                if(auth()){
                    if($dadoObjetoServico->getUsuarioId() != getUser()->getId()){
                        $novoServico = new Servico();
                        $novoServico->setId($dadoObjetoServico->getId());
                        $novoServico->setTitulo($dadoObjetoServico->getTitulo());
                        $novoServico->setDescricao($dadoObjetoServico->getDescricao());
                        $novoServico->setEnderecoServico($dadoObjetoServico->getEnderecoServico());
                        $novoServico->setValor($dadoObjetoServico->getValor());
                        $novoServico->setUsuarioId($usuarioDao->buscarPeloId($dadoObjetoServico->getUsuarioId()));
                        $novoServico->setDataPostagem($dadoObjetoServico->getDataPostagem());
                        $novoServico->setStatus($dadoObjetoServico->getStatus());
                        $servicos [] = array(
                            'servicos' => $novoServico,
                            'categorias' => $servicoCategoriaDao->buscarCategoriasDoServico($novoServico->getId())
                        );
                    }
                } else {
                    $novoServico = new Servico();
                    $novoServico->setId($dadoObjetoServico->getId());
                    $novoServico->setTitulo($dadoObjetoServico->getTitulo());
                    $novoServico->setDescricao($dadoObjetoServico->getDescricao());
                    $novoServico->setEnderecoServico($dadoObjetoServico->getEnderecoServico());
                    $novoServico->setValor($dadoObjetoServico->getValor());
                    $novoServico->setUsuarioId($usuarioDao->buscarPeloId($dadoObjetoServico->getUsuarioId()));
                    $novoServico->setDataPostagem($dadoObjetoServico->getDataPostagem());
                    $novoServico->setStatus($dadoObjetoServico->getStatus());
                    $servicos [] = array(
                        'servicos' => $novoServico,
                        'categorias' => $servicoCategoriaDao->buscarCategoriasDoServico($novoServico->getId())
                    );
                }
            }
        }
        return $servicos;
    }

    if(isset($_GET['categoria']) && isset($_GET['descricao'])){
        $servicos = buscarServicos($usuarioDao, $servicoDao, $servicoCategoriaDao, true); //pega os serviços com filtro

    } else {
        $servicos = buscarServicos($usuarioDao, $servicoDao, $servicoCategoriaDao, false); //pega todos os serviços sem filtro
        
    }
    $categoriaDao = new CategoriaDaoMysql($pdo);

    $categorias = [];
    $categoriasBanco = $categoriaDao->buscarTodas();

    foreach($categoriasBanco as $c) {
        $novaCategoria = new Categoria();
        $novaCategoria->setId($c->getId());
        $novaCategoria->setNome($c->getNome());
        $categorias [] = $novaCategoria;
    }

?>
<div class="container-job">
    <h2 class="text-black-50 text-center text-uppercase mb-5" style="font-size: max(2.5vw, 12pt)">
        Encontre o <u><strong>JOB</strong></u> ideal para você
    </h2>
    <div class="d-flex">
        <input type="checkbox" checked class="d-none" id="close_navbar" />
        <label for="close_navbar" class="cursor_pointer">
            <i class="fas fa-bars fa-2x ml-2"></i>
        </label>

        <filtro-jobs-component categorias='<?php echo json_encode($categorias);?>' url="<?php echo $routes->jobs?>"></filtro-jobs-component>
        <list-jobs-component home="<?php echo $routes->home?>" servicos='<?php echo json_encode($servicos);?>' show_job="<?php echo $routes->jobs_show?>">
            <list-jobs-component>
    </div>
</div>
<?php require "layouts/app/footer.php"?>