<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\MensagemDaoMysql; 
use App\Dao\UsuarioDaoMysql; 

$pdo = Conexao::getInstance();

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$userId = intval($data['id']);

$mensagenDao = new MensagemDaoMysql($pdo);
$usuarioDao = new UsuarioDaoMysql($pdo);

$usuarioSessao = $usuarioDao->buscarPeloId($userId);

if(!$usuarioSessao){
    echo json_encode(array('status' => false));
}
else {

     //Recuperando as mensagens enviadas ou recebidas pelo usuário da sessão
     $dataMensagens = $mensagenDao->buscarMensagens($usuarioSessao->getId());
 
     $contatos = [];
 
     if ($dataMensagens) {
         
         foreach($dataMensagens as $m) {
              
             //pega os usuários que enviaram ou recebream mensagens do usuário logado, e armazena em contatos
             if (!array_key_exists($m['contratado_id'], $contatos) && $m['contratado_id'] != $usuarioSessao->getId()) {
 
                 $contatos[$m['contratado_id']] = $usuarioDao->buscarPeloId($m['contratado_id']);
             }
             if (!array_key_exists($m['contratante_id'], $contatos) && $m['contratante_id'] != $usuarioSessao->getId()) {
 
                 $contatos[$m['contratante_id']] = $usuarioDao->buscarPeloId($m['contratante_id']);
             }
         }   
     }

    $jsonContatos = json_encode(array('status' => true, 'contatos' => $contatos));
    echo $jsonContatos;
}