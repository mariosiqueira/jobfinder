<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\ServicoDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET
use App\Dao\ServicoCategoriaDaoMysql; 

use App\VO\Servico;

$pdo = Conexao::getInstance();

if(!isset($_SESSION['auth'])){
    echo json_encode('erro');

}
else {

    $servicoDao = new ServicoDaoMysql($pdo);

    $servicos = [];

    $servicoCategoria = new ServicoCategoriaDaoMysql($pdo);

    $usuarioSessao = unserialize($_SESSION['auth']);

    $arrayDadosObjetosServico = $servicoDao->buscarServicoPeloIdDoUsuario($usuarioSessao->getId());
    if($arrayDadosObjetosServico != null) {
        
        foreach($arrayDadosObjetosServico as $dadoObjetoServico) {
            $novoServico = new Servico();
            $novoServico->setId($dadoObjetoServico->getId());
            $novoServico->setTitulo($dadoObjetoServico->getTitulo());
            $novoServico->setDescricao($dadoObjetoServico->getDescricao());
            $novoServico->setEnderecoServico($dadoObjetoServico->getEnderecoServico());
            $novoServico->setValor($dadoObjetoServico->getValor());
            $novoServico->setUsuarioId($dadoObjetoServico->getUsuarioId());
            $novoServico->setDataPostagem($dadoObjetoServico->getDataPostagem());
            $novoServico->setStatus($dadoObjetoServico->getStatus());

            $servicos [] = array(
                'servico' => $novoServico,
                'categorias' => $servicoCategoria->buscarCategoriasDoServico($novoServico->getId())
            );
        }
    }

    $jsonServicos = json_encode($servicos);
    echo $jsonServicos;
}