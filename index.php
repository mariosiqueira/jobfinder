<?php
session_start();
require "config/config.php";
// tratamento da url de serviço 
$jobs_show = isset($_GET['s']) ? "?s=$_GET[s]" : "";

//tratamento de rotas
$routes_navigation = [
    "/" => "welcome.php",
    "/index.php" => "welcome.php",
    "/login" => "login.php",
    "/register" => "cadastro.php",
    "/profile" => "perfil.php",
    "/messages" => "mensagens.php",
    "/jobs" => "jobs.php",
    "/jobs/show/$jobs_show" => "single_job.php",
    "/notFound" => "pageNotFound.php",
    "/usuarios/criar" => "../controller/action_cadastro.php",
    "/usuarios/editar" => "../controller/editar_conta.php",
    "/usuarios/deletar" => "../controller/action_deletar_conta.php",
    "/usuarios/logar" => "../controller/action_login.php",
    "/logouturl" => "../controller/action_logout.php",
    "/url_edit_servico" => "../controller/action_edit_servico.php",
    "/usuarios/alterar_apelido" => "../controller/alterar_apelido.php",
    "/services/close" => "../controller/action_cadastro_usuario_servico.php",
    "/services/proposta" => "../controller/action_proposta.php",
]; 

$routes = (Object) [ //rotas nomeadas e suas respectivas url's
    "home"=> "https://$_SERVER[HTTP_HOST]/",
    "perfil"=> "https://$_SERVER[HTTP_HOST]/profile",
    "mensagens"=> "https://$_SERVER[HTTP_HOST]/messages",
    "login"=> "https://$_SERVER[HTTP_HOST]/login",
    "cadastro"=> "https://$_SERVER[HTTP_HOST]/register",
    "jobs"=> "https://$_SERVER[HTTP_HOST]/jobs",
    "jobs_show"=> "https://$_SERVER[HTTP_HOST]/jobs/show/$jobs_show",
    "action_cadastro" => "https://$_SERVER[HTTP_HOST]/usuarios/criar",
    "action_login" => "https://$_SERVER[HTTP_HOST]/usuarios/logar",
    "editar_conta" => "https://$_SERVER[HTTP_HOST]/usuarios/editar",
    "alterar_apelido" => "https://$_SERVER[HTTP_HOST]/usuarios/alterar_apelido",
    "deletar_conta" => "https://$_SERVER[HTTP_HOST]/usuarios/deletar",
    "logout" => "https://$_SERVER[HTTP_HOST]/logouturl",
    "edit_job" => "https://$_SERVER[HTTP_HOST]/url_edit_servico",
    "close_job" => "https://$_SERVER[HTTP_HOST]/services/close",
    "proposta" => "https://$_SERVER[HTTP_HOST]/services/proposta",
];

$req = $_SERVER['REQUEST_URI']; //pega a url 

if (array_key_exists($req, $routes_navigation)) { //verifica se a url requisitada existe nas rotas cadastrdas
    require "views/$routes_navigation[$req]"; //se existir e faz o require no arquivo da chave do array 
} else {
    require "views/".$routes_navigation["/notFound"]; //se não existir faz o require na chave notFound
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