<?php
session_start();

// tratamento da url de serviço 
$jobs_show = isset($_GET['s']) ? "?s=$_GET[s]" : "";

//tratamento de rotas
$routes_navigation = [
    "/jobfinder/" => "welcome.php",
    "/jobfinder/index.php" => "welcome.php",
    "/jobfinder/index.php/" => "welcome.php",
    "/jobfinder/login" => "login.php",
    "/jobfinder/register" => "cadastro.php",
    "/jobfinder/profile" => "perfil.php",
    "/jobfinder/messages" => "mensagens.php",
    "/jobfinder/jobs" => "jobs.php",
    "/jobfinder/jobs/show/$jobs_show" => "single_job.php",
    "/jobfinder/notFound" => "pageNotFound.php",
    "/jobfinder/usuarios/criar" => "../controller/action_cadastro.php",
    "/jobfinder/usuarios/editar" => "../controller/editar_conta.php",
    "/jobfinder/usuarios/deletar" => "../controller/action_deletar_conta.php",
    "/jobfinder/usuarios/logar" => "../controller/action_login.php",
    "/jobfinder/logouturl" => "../controller/action_logout.php",
    "/jobfinder/url_edit_servico" => "../controller/action_edit_servico.php",
    "/jobfinder/usuarios/alterar_apelido" => "../controller/alterar_apelido.php",
    "/jobfinder/services/close" => "../controller/action_cadastro_usuario_servico.php",
    "/jobfinder/services/proposta" => "../controller/action_proposta.php",
]; 

$routes = (Object) [ //rotas nomeadas e suas respectivas url's
    "home"=> "http://$_SERVER[HTTP_HOST]/jobfinder/",
    "perfil"=> "http://$_SERVER[HTTP_HOST]/jobfinder/profile",
    "mensagens"=> "http://$_SERVER[HTTP_HOST]/jobfinder/messages",
    "login"=> "http://$_SERVER[HTTP_HOST]/jobfinder/login",
    "cadastro"=> "http://$_SERVER[HTTP_HOST]/jobfinder/register",
    "jobs"=> "http://$_SERVER[HTTP_HOST]/jobfinder/jobs",
    "jobs_show"=> "http://$_SERVER[HTTP_HOST]/jobfinder/jobs/show/$jobs_show",
    "action_cadastro" => "http://$_SERVER[HTTP_HOST]/jobfinder/usuarios/criar",
    "action_login" => "http://$_SERVER[HTTP_HOST]/jobfinder/usuarios/logar",
    "editar_conta" => "http://$_SERVER[HTTP_HOST]/jobfinder/usuarios/editar",
    "alterar_apelido" => "http://$_SERVER[HTTP_HOST]/jobfinder/usuarios/alterar_apelido",
    "deletar_conta" => "http://$_SERVER[HTTP_HOST]/jobfinder/usuarios/deletar",
    "logout" => "http://$_SERVER[HTTP_HOST]/jobfinder/logouturl",
    "edit_job" => "http://$_SERVER[HTTP_HOST]/jobfinder/url_edit_servico",
    "close_job" => "http://$_SERVER[HTTP_HOST]/jobfinder/services/close",
    "proposta" => "http://$_SERVER[HTTP_HOST]/jobfinder/services/proposta",
];

$req = $_SERVER['REQUEST_URI']; //pega a url 

if (array_key_exists($req, $routes_navigation)) { //verifica se a url requisitada existe nas rotas cadastrdas
    require "views/$routes_navigation[$req]"; //se existir e faz o require no arquivo da chave do array 
} else {
    require "views/".$routes_navigation["/jobfinder/notFound"]; //se não existir faz o require na chave notFound
}

function auth(){ //funçao pra verificar se o usuario está autenticado
    if(isset($_SESSION['auth'])){
        return true;
    }
    return false;
}
function check_auth($routes){ //função pra verificar se o usuário estpa autenticado
    if(!auth()){
        return header("location: $routes->login");
    }
}

function getUser(){ // se existir a sessão pega os dados do usuario logado
    if (auth()) {
        return unserialize($_SESSION['auth']);
    } else {
        return array();
    }
    
}

function dd($data){
    var_dump($data);
    die();
}