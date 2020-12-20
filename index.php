<?php

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
]; 

$routes = (Object) [ //rotas nomeadas e suas respectivas url's
    "home"=> "http://$_SERVER[HTTP_HOST]/jobfinder/",
    "perfil"=> "http://$_SERVER[HTTP_HOST]/jobfinder/profile",
    "mensagens"=> "http://$_SERVER[HTTP_HOST]/jobfinder/messages",
    "login"=> "http://$_SERVER[HTTP_HOST]/jobfinder/login",
    "cadastro"=> "http://$_SERVER[HTTP_HOST]/jobfinder/register",
    "jobs"=> "http://$_SERVER[HTTP_HOST]/jobfinder/jobs",
    "jobs_show"=> "http://$_SERVER[HTTP_HOST]/jobfinder/jobs/show/$jobs_show",
];

$req = $_SERVER['REQUEST_URI']; //pega a url 

if (array_key_exists($req, $routes_navigation)) { //verifica se a url requisitada existe nas rotas cadastrdas
    require "views/$routes_navigation[$req]"; //se existir e faz o require no arquivo da chave do array 
} else {
    require "views/".$routes_navigation["/jobfinder/notFound"]; //se não existir faz o require na chave notFound
}

function auth(){ //funçao pra verificar se o usuario está autenticado
    session_start();
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