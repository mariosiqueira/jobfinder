<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //Import do PDO para usar na classe UsuarioDaoMysql
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php'; // Import da classe UsuarioDaoMysql para atualizar os dados do usuário
session_start();

$usuarioDao = new UsuarioDaoMysql($pdo);

function editarDados($usuarioDao){
    $novoNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $novoTelefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

    if($novoNome && $novoTelefone){
        $usuario = unserialize($_SESSION['auth']); //Usuário vai pegar todos os dados da sessão
        $usuario = $usuarioDao->buscarPeloId($usuario->getId()); //O usuário vai pegar todos os dados pelo id, inclusive a senha que foi deixada em branco por questões de segurança

        $usuario->setNome($novoNome); //Seta um novo nome para o usuário
        $usuario->setTelefone($novoTelefone); //Seta um novo telefone para o usuário
        
        session_start();
        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Dados editados com sucesso!'
        ];

        $usuarioDao->atualizar($usuario); //Grava as atualizações no banco de dados
        
        $usuario->setSenha(""); //Zera a senha para ser salva na sessão
        $_SESSION['auth'] = serialize($usuario); //salva o usuário na sessão
    }
    
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile'); //encaminha para a página de perfil
    exit();
}

editarDados($usuarioDao);