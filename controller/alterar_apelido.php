<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //importa o PDO para utilizar na classe UsuarioDaoMysql
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php'; //Atualiza o apelido do usuário
session_start();

$usuarioDao = new UsuarioDaoMysql($pdo);

function atualizarApelido($usuarioDao){
    $novoApelido = filter_input(INPUT_POST, 'apelido', FILTER_SANITIZE_STRING); //Recebe o novo apelido passado no formulário
    
    if($novoApelido){
        $usuario = unserialize($_SESSION['auth']); //Recupera o usuário da sessão
        $usuario = $usuarioDao->buscarPeloId($usuario->getId()); //busca os dados do usuário pelo id que foi recuperado da sessão
        $usuario->setApelido($novoApelido); //seta um novo apelido no objeto usuário
        
        session_start();
        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Apelido editado com sucesso!'
        ];

        $usuarioDao->atualizar($usuario); //chama o método atualizar de usuarioDao passando o usuário com o apelido alterado.
        $usuario->setSenha(""); //remove a senha do usuário para ser passado para a sessão.
        $_SESSION['auth'] = serialize($usuario);
    }
    
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

atualizarApelido($usuarioDao);