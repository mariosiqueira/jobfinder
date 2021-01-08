<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/config.php'; //import do pdo
require $_SERVER['DOCUMENT_ROOT'].'/dao/ServicoDaoMysql.php'; //import da classe ServicoDaoMysql para deletar o serviço
require $_SERVER['DOCUMENT_ROOT'].'/dao/ServicoCategoriaDaoMysql.php'; //import da classe ServicoCategoriaDaoMysql para deletar primeiro a associação da categoria ao serviço e em seguida deletar o serviço
require $_SERVER['DOCUMENT_ROOT'].'/dao/UsuarioServicoDaoMysql.php'; //import da classe UsuarioServicoDaoMysql para deletar a associação entre o contratante, contratado e o serviço

$servicoDao = new ServicoDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);
$usuarioServicoDao = new UsuarioServicoDaoMysql($pdo);

function deletarServico($servicoDao, $servicoCategoriaDao, $usuarioServicoDao) {
    $servicoId = intval(filter_input(INPUT_GET, 'id'));
    $servicoCategoriaDao->deletar($servicoId); //para deletar um serviço é necessário deletar a categoria que faz associação a ele por causa das chaves estrangeiras
    $usuarioServicoDao->deletarPeloServicoId($servicoId); //Deleta a associação do id do serviço na tabela usuario_servico do banco de dados

    session_start();
    $_SESSION['message'] = (Object) [
        'type'=>'info',
        'message' => 'Serviço deletado com sucesso!'
    ];
    $servicoDao->deletar($servicoId);
}

deletarServico($servicoDao, $servicoCategoriaDao, $usuarioServicoDao);