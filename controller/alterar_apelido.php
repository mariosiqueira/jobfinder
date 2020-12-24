<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php';
session_start();

$usuarioDao = new UsuarioDaoMysql($pdo);

$novoApelido = filter_input(INPUT_POST, 'apelido', FILTER_SANITIZE_STRING);

function atualizarApelido($usuarioDao, $novoApelido){
    if($novoApelido){
        $usuario = unserialize($_SESSION['auth']);
        $usuario->setApelido($novoApelido);
    
        $usuarioDao->atualizar($usuario);
        $_SESSION['auth'] = serialize($usuario);
    }
    
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

atualizarApelido($usuarioDao, $novoApelido);