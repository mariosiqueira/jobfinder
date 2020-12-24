<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //Importa o PDO
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php'; //Importa UsuarioDaoMysql para o CRUD

$usuarioDaoMysql = new UsuarioDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$apelido = explode(" ", $nome)[0]; //O apelido é o primeiro nome do usuário
$telefone = filter_input(INPUT_POST,'telefone', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,'email');
$senha = filter_input(INPUT_POST,'senha');
$fotoPerfil = "default-user-img.jpg"; //foto default que todos os usuários terão ao se cadastrar no sistema

//Para que o usuário possa se cadastrar no sistema, ele deverá preecher todos os dados do formulário de cadastro corretamente. A próxima linha faz essa verificação
if($senha && $nome && $telefone && $email) {
    //Só pode haver um usuário cadastrado com um determinado e-mail. A próxima linha checa se o e-mail digitado pelo usuário já foi utilizado por algum usuário
    if($usuarioDaoMysql->buscarPeloEmail($email) == false) {
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($nome);
        $novoUsuario->setTelefone($telefone);
        $novoUsuario->setEmail($email);
        $novoUsuario->setSenha($senha);
        $novoUsuario->setFotoPerfil($fotoPerfil);
        $novoUsuario->setApelido($apelido);

        $usuarioDaoMysql->salvar($novoUsuario);
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/login');
        exit;

    } else {
        echo 'Usuário já existe';
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/register');
        exit;
    }

} else {
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/register');
    exit;
}