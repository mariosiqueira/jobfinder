<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\MensagemDaoMysql; 
use App\Dao\UsuarioDaoMysql; 

$pdo = Conexao::getInstance();

if(!isset($_SESSION['auth'])){
    echo json_encode('erro');
}
else {

    $usuarioSessao = unserialize($_SESSION['auth']);

     //Recuperando as mensagens enviadas ou recebidas pelo usuário da sessão
     $usuarioDao = new UsuarioDaoMysql($pdo);
     $mensagenDao = new MensagemDaoMysql($pdo);
     $dataMensagens = $mensagenDao->buscarMensagens($usuarioSessao->getId());
 
     $contatos = [];
 
     if ($dataMensagens) {
         
         foreach($dataMensagens as $m) {
              
             //pega os usuários que enviaram ou recebream mensagens do usuário logado, e armazena em contatos
             if (!array_key_exists($m['contratado_id'], $contatos) && $m['contratado_id'] != getUser()->getId()) {
 
                 $contatos[$m['contratado_id']] = $usuarioDao->buscarPeloId($m['contratado_id']);
             }
             if (!array_key_exists($m['contratante_id'], $contatos) && $m['contratante_id'] != getUser()->getId()) {
 
                 $contatos[$m['contratante_id']] = $usuarioDao->buscarPeloId($m['contratante_id']);
             }
         }   
     }

    $jsonServicos = json_encode($contatos);
    echo $jsonServicos;
}