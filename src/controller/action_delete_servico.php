<?php

use App\Config\Conexao; //import do pdo
use App\Dao\ServicoDaoMysql; //import da classe ServicoDaoMysql para deletar o serviço

$pdo = Conexao::getInstance();

$servicoDao = new ServicoDaoMysql($pdo);

function deletarServico($servicoDao) {
    $servicoId = intval(filter_input(INPUT_POST, 'id'));

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
        }

    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

deletarServico($servicoDao);