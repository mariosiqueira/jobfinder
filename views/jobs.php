
<?php require "layouts/app/head.php";
require $_SERVER['DOCUMENT_ROOT'].'/dao/ServicoDaoMysql.php'; 

$usuarioDao = new UsuarioDaoMysql($pdo);
$servicoDao = new ServicoDaoMysql($pdo);
$servicos = [];

$arrayDadosObjetosServico = $servicoDao->buscarTodos();
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
                $servicos [] = $novoServico;
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
            $servicos [] = $novoServico;
        }
    }
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

        <filtro-jobs-component></filtro-jobs-component>
        <list-jobs-component home="<?php echo $routes->home?>" servicos='<?php echo json_encode($servicos);?>' show_job="<?php echo $routes->jobs_show?>">
            <list-jobs-component>
    </div>
</div>
<?php require "layouts/app/footer.php"?>