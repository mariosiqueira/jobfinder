<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\UsuarioDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET
use App\Dao\ServicoDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET
use App\Dao\ServicoCategoriaDaoMysql; 

use App\VO\Servico;

$pdo = Conexao::getInstance();

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$userId = intval($data['id']);

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuarioSessao = $usuarioDao->buscarPeloId($userId);

if(!$usuarioSessao){
    echo json_encode(array('status' => false));
}
else {

    $servicoDao = new ServicoDaoMysql($pdo);

    $servicos = [];

    $servicoCategoria = new ServicoCategoriaDaoMysql($pdo);

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

    $jsonServicos = json_encode(array('status' => true, 'servicos' => $servicos));
    echo $jsonServicos;
}