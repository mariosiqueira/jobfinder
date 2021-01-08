<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/config.php'; //Importa o PDO
require $_SERVER['DOCUMENT_ROOT'].'/dao/MensagemDaoMysql.php'; //Importa MensagemDaoMysql para o CRUD

$mensagemDaoMysql = new MensagemDaoMysql($pdo);

$contratante_id = filter_input(INPUT_POST, 'contratante_id', FILTER_SANITIZE_STRING);
$contratado_id = filter_input(INPUT_POST, 'contratado_id', FILTER_SANITIZE_STRING);
$mensagem = filter_input(INPUT_POST,'mensagem', FILTER_SANITIZE_STRING);


if($contratante_id && $contratado_id && $mensagem) {

    $_SESSION['message'] = (Object) [
        'type'=>'info',
        'message' => 'Sua proposta foi registrada com sucesso!'
    ];

    $novaProposta = new Mensagem();
    $novaProposta->setContratanteId($contratante_id);
    $novaProposta->setContratadoId($contratado_id);
    $novaProposta->setMensagem($mensagem);

    $mensagemDaoMysql->salvar($novaProposta);
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobs');
    exit;

    } else {
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobs');
        exit;
}