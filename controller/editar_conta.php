<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php';
session_start();

$usuarioDao = new UsuarioDaoMysql($pdo);

$novoNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$novoTelefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

function editarApelido($usuarioDao, $novoNome, $novoTelefone){
    if($novoNome && $novoTelefone){
        $usuario = unserialize($_SESSION['auth']);

        $usuario->setNome($novoNome);
        $usuario->setTelefone($novoTelefone);
    
        $usuarioDao->atualizar($usuario);
        
        $_SESSION['auth'] = null;

        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/login');
    }
    
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

editarApelido($usuarioDao, $novoNome, $novoTelefone);