<?php
use App\Config\Conexao;//Importa o PDO
use App\Dao\MensagemDaoMysql; //Importa MensagemDaoMysql para o CRUD
use App\Dao\ChatDaoMysql;

use App\VO\Mensagem;

$pdo = Conexao::getInstance();

$mensagemDaoMysql = new MensagemDaoMysql($pdo);

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$contratante_id = intval($data['contratante_id']);
$contratado_id = intval($data['contratado_id']);
$msg = $data['mensagem'];

if($contratante_id && $contratado_id && $msg) {

    $mensagem = new Mensagem();
    $mensagem->setContratanteId($contratante_id);
    $mensagem->setContratadoId($contratado_id);
    $mensagem->setMensagem($msg);

    $chat = new ChatDaoMysql();
    $chat->send($mensagem);
    
    $mensagemDaoMysql->salvar($mensagem);
}