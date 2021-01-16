<?php
session_start();

require_once(__DIR__.'/vendor/autoload.php');
// tratamento da url de serviço e filtro
$jobs_show = isset($_GET['s']) ? "?s=$_GET[s]" : "";

$descricao = isset($_GET['descricao']) ? urlencode($_GET['descricao']) : null;// str_replace(' ', '+', $_GET['descricao']) : null;
$filter = isset($_GET['categoria']) ? "?descricao=$descricao&categoria=$_GET[categoria]" : "";

//tratamento de rotas
$routes_navigation = [
    "/" => "welcome.php",
    "/index.php" => "welcome.php",
    "/index.php/" => "welcome.php",
    "/login" => "login.php",
    "/register" => "cadastro.php",
    "/profile" => "perfil.php",
    "/jobs$filter" => "jobs.php",
    "/jobs/filter" => "../controller/filter_job.php",
    "/jobs/show/$jobs_show" => "single_job.php",
    "/notFound" => "pageNotFound.php",
    "/usuarios/salvar_mensagem" => "../controller/action_salvar_mensagem.php",
    "/usuarios/criar" => "../controller/action_cadastro.php",
    "/usuarios/editar" => "../controller/editar_conta.php",
    "/usuarios/deletar" => "../controller/action_deletar_conta.php",
    "/usuarios/logar" => "../controller/action_login.php",
    "/usuarios/alterar_imagem" => "../controller/usuario_imagem.php",
    "/logouturl" => "../controller/action_logout.php",
    "/url_edit_servico" => "../controller/action_edit_servico.php",
    "/usuarios/alterar_apelido" => "../controller/alterar_apelido.php",
    "/services/create" => "../controller/action_cadastrar_servico_e_servico_categoria.php",
    "/services/delete" => "../controller/action_delete_servico.php",
    "/services/close" => "../controller/action_cadastro_usuario_servico.php",
    "/services/proposta" => "../controller/action_proposta.php",
]; 

$routes = (Object) [ //rotas nomeadas e suas respectivas url's
    "home"=> "https://$_SERVER[HTTP_HOST]/",
    "perfil"=> "https://$_SERVER[HTTP_HOST]/profile",
    "salvar_mensagem"=> "https://$_SERVER[HTTP_HOST]/usuarios/salvar_mensagem",
    "login"=> "https://$_SERVER[HTTP_HOST]/login",
    "cadastro"=> "https://$_SERVER[HTTP_HOST]/register",
    "jobs"=> "https://$_SERVER[HTTP_HOST]/jobs$filter",
    "jobs_filter"=> "https://$_SERVER[HTTP_HOST]/jobs/filter",
    "jobs_show"=> "https://$_SERVER[HTTP_HOST]/jobs/show/$jobs_show",
    "action_cadastro" => "https://$_SERVER[HTTP_HOST]/usuarios/criar",
    "action_login" => "https://$_SERVER[HTTP_HOST]/usuarios/logar",
    "editar_conta" => "https://$_SERVER[HTTP_HOST]/usuarios/editar",
    "alterar_apelido" => "https://$_SERVER[HTTP_HOST]/usuarios/alterar_apelido",
    "alterar_imagem" => "https://$_SERVER[HTTP_HOST]/usuarios/alterar_imagem",
    "deletar_conta" => "https://$_SERVER[HTTP_HOST]/usuarios/deletar",
    "logout" => "https://$_SERVER[HTTP_HOST]/logouturl",
    "create_job" => "https://$_SERVER[HTTP_HOST]/services/create",
    "delete_job" => "https://$_SERVER[HTTP_HOST]/services/delete",
    "edit_job" => "https://$_SERVER[HTTP_HOST]/url_edit_servico",
    "close_job" => "https://$_SERVER[HTTP_HOST]/services/close",
    "proposta" => "https://$_SERVER[HTTP_HOST]/services/proposta",
];

$req = $_SERVER['REQUEST_URI']; //pega a url 

if (array_key_exists($req, $routes_navigation)) { //verifica se a url requisitada existe nas rotas cadastrdas
    require "src/views/$routes_navigation[$req]"; //se existir e faz o require no arquivo da chave do array 
} else {
    require "src/views/".$routes_navigation["/notFound"]; //se não existir faz o require na chave notFound
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