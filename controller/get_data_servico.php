<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //import do pdo para utilizar na classe ServicoDaoMysql
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoDaoMysql.php'; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET

$servicoDao = new ServicoDaoMysql($pdo);

$servicoId = intval($_GET['s']); //Recebido na query GET pelo axios no arquivo servico_show.js

$servicoBuscado = $servicoDao->buscarPeloId($servicoId);
$jsonServico = json_encode($servicoBuscado);
echo ($jsonServico);