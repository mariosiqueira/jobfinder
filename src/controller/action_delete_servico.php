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
    $servicoCategoriaDao->deletar($servicoId); //para deletar um serviço é necessário deletar a categoria que faz associação a ele por causa das chaves estrangeiras
    $usuarioServicoDao->deletarPeloServicoId($servicoId); //Deleta a associação do id do serviço na tabela usuario_servico do banco de dados

    $_SESSION['message'] = (Object) [
        'type'=>'info',
        'message' => 'Serviço deletado com sucesso!'
    ];
    $servicoDao->deletar($servicoId);
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
}

deletarServico($servicoDao, $servicoCategoriaDao, $usuarioServicoDao);