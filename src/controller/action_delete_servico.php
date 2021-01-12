<?php

use App\Config\Conexao; //import do pdo
use App\Dao\ServicoDaoMysql; //import da classe ServicoDaoMysql para deletar o serviço
use App\Dao\ServicoCategoriaDaoMysql; //import da classe ServicoCategoriaDaoMysql para deletar primeiro a associação da categoria ao serviço e em seguida deletar o serviço
use App\Dao\UsuarioServicoDaoMysql; //import da classe UsuarioServicoDaoMysql para deletar a associação entre o contratante, contratado e o serviço

$pdo = Conexao::getInstance();
$servicoDao = new ServicoDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);
$usuarioServicoDao = new UsuarioServicoDaoMysql($pdo);

function deletarServico($servicoDao, $servicoCategoriaDao, $usuarioServicoDao) {
    $servicoId = intval(filter_input(INPUT_POST, 'id'));
    $deletouCategoria = $servicoCategoriaDao->deletar($servicoId); //para deletar um serviço é necessário deletar a categoria que faz associação a ele por causa das chaves estrangeiras
    
    if($deletouCategoria == false) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado!'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
        exit();
    }

    $deletouUsuarioServico = $usuarioServicoDao->deletarPeloServicoId($servicoId); //Deleta a associação do id do serviço na tabela usuario_servico do banco de dados

    if($deletouUsuarioServico == false) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado!'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
        exit();
    }

    $deletouServico = $servicoDao->deletar($servicoId);

    if($deletouServico == true) {
        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Serviço deletado com sucesso!'
        ];
    } else {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao deletar o serviço!'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
        exit();
    }

    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

deletarServico($servicoDao, $servicoCategoriaDao, $usuarioServicoDao);