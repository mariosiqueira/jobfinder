<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\MensagemDaoMysql; 
use App\Dao\UsuarioDaoMysql; 

$pdo = Conexao::getInstance();

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$userId = intval($data['id']);

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuarioSessao = $usuarioDao->buscarPeloId($userId);

if(!$usuarioSessao){
    
    echo json_encode(array('status' => false));
}
else {

     //Recuperando as mensagens enviadas ou recebidas pelo usuário da sessão
     $usuarioDao = new UsuarioDaoMysql($pdo);
     $mensagenDao = new MensagemDaoMysql($pdo);
     $dataMensagens = $mensagenDao->buscarMensagens($usuarioSessao->getId());
 
     $mensagens = [];
     $contatos = [];
 
     if ($dataMensagens) {
         
         foreach($dataMensagens as $m) {
             
             // pega todas as mesagens enviadas ou recebidas do usuario logado, e armazena em mensagens
             $mensagens[] = [ 
                 "id" => $m['id'],
                 "contratante_id" => $m['contratante_id'],
                 "contratado_id" => $m['contratado_id'],
                 "mensagem" => $m['mensagem'],
             ]; 
 
             //pega os usuários que enviaram ou recebream mensagens do usuário logado, e armazena em contatos
             if (!array_key_exists($m['contratado_id'], $contatos) && $m['contratado_id'] != $usuarioSessao->getId()) {
 
                 $contatos[$m['contratado_id']] = $usuarioDao->buscarPeloId($m['contratado_id']);
             }
             if (!array_key_exists($m['contratante_id'], $contatos) && $m['contratante_id'] != $usuarioSessao->getId()) {
 
                 $contatos[$m['contratante_id']] = $usuarioDao->buscarPeloId($m['contratante_id']);
             }
         }   
     }

    $jsonServicos = json_encode(array('status' => true, 'mensagens' => $mensagens, 'contatos' => $contatos));
    echo $jsonServicos;
}