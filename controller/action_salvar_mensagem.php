<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //Importa o PDO
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/MensagemDaoMysql.php'; //Importa MensagemDaoMysql para o CRUD

$mensagemDaoMysql = new MensagemDaoMysql($pdo);

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$contratante_id = intval($data['contratante_id']);
$contratado_id = intval($data['contratado_id']);
$msg = $data['mensagem'];

if($contratante_id && $contratado_id && $msg) {

    $_SESSION['message'] = (Object) [
        'type'=>'info',
        'message' => 'Sua proposta foi registrada com sucesso!'
    ];

    $mensagem = new Mensagem();
    $mensagem->setContratanteId($contratante_id);
    $mensagem->setContratadoId($contratado_id);
    $mensagem->setMensagem($msg);

    $mensagemDaoMysql->salvar($mensagem);
}