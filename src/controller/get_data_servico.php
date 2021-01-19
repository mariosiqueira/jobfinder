<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\ServicoDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET

$pdo = Conexao::getInstance();

$servicoDao = new ServicoDaoMysql($pdo);

$servicoId = intval($_GET['s']); //Recebido na query GET pelo axios no arquivo servico_show.js

$servicoBuscado = $servicoDao->buscarPeloId($servicoId);
$jsonServico = json_encode($servicoBuscado);
echo $jsonServico;