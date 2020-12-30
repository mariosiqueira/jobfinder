<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //import do pdo
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoDaoMysql.php'; //import da classe ServicoDaoMysql para deletar o serviço
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoCategoriaDaoMysql.php'; //import da classe ServicoCategoriaDaoMysql para deletar primeiro a associação da categoria ao serviço e em seguida deletar o serviço

$servicoDao = new ServicoDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);

function deletarServico($servicoDao, $servicoCategoriaDao) {
    $servicoId = intval(filter_input(INPUT_GET, 'id'));
    $servicoCategoriaDao->deletar($servicoId); //para deletar um serviço é necessário deletar a categoria que faz associação a ele por causa das chaves estrangeiras
    $servicoDao->deletar($servicoId);
}

deletarServico($servicoDao, $servicoCategoriaDao);