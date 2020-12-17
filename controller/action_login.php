<?php 
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //Importa o PDO
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php'; //Importa UsuarioDaoMysql para o CRUD
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/controller/controle_sessao.php'; //Importa o controle de sessão para que caso o usuário só acesse uma determinada página se existir uma sessão ativa

$usuarioDaoMysql = new UsuarioDaoMysql($pdo);

$email = filter_input(INPUT_POST,'email');
$senha = filter_input(INPUT_POST,'senha');
$lembrar = isset($_POST['lembrar']) ? $_POST['lembrar'] : null; //valor on gerado quando marca-se o checkbox lembrar de mim na página de login

//O método a seguir realiza a autenticação do usuário no sistema verificando se os dados do e-mail e a senha coincidem no banco de dados.
function autenticarUsuario($email, $senha, $usuarioDaoMysql, $lembrar) {
    $usuarioBuscado = $usuarioDaoMysql->buscarPorEmail($email);
    if($usuarioBuscado != false){

        if($usuarioBuscado->getSenha() == $senha){

            //Caso o checkbox lembrar de mim na página de login tenha sido marcado, uma sessão com o id do usuário será salva
            salvarSessao($usuarioBuscado->getId(), $lembrar);
            header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/jobs');
            exit;

        } else {
            header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/login');
            exit;
        }

    } else {
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/login');
        exit;
    }
}

function salvarSessao($id, $lembrar) {
    if($lembrar == 'on'){
        $_SESSION['id'] = $id;
    }
}

autenticarUsuario($email, $senha, $usuarioDaoMysql, $lembrar);