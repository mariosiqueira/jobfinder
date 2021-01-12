<?php
use App\Config\Conexao;//importa o PDO para utilizar na classe UsuarioDaoMysql
use App\Dao\UsuarioDaoMysql; //Atualiza o apelido do usuário

$pdo = Conexao::getInstance();

$usuarioDao = new UsuarioDaoMysql($pdo);

function atualizarApelido($usuarioDao){
    session_start();

    $novoApelido = filter_input(INPUT_POST, 'apelido', FILTER_SANITIZE_STRING); //Recebe o novo apelido passado no formulário
    
    if($novoApelido){
        $usuario = unserialize($_SESSION['auth']); //Recupera o usuário da sessão
        $usuario = $usuarioDao->buscarPeloId($usuario->getId()); //busca os dados do usuário pelo id que foi recuperado da sessão
        
        if(is_null($usuario)) {
            $_SESSION['message'] = (Object) [
                'type'=>'error',
                'message' => 'Ocorreu um erro ao encontrar seu usuário. E o apelido não foi alterado!'
            ];
            header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
            exit();
        }

        $usuario->setApelido($novoApelido); //seta um novo apelido no objeto usuário
        $atualizouApelido = $usuarioDao->atualizar($usuario); //chama o método atualizar de usuarioDao passando o usuário com o apelido alterado.
        
        if($atualizouApelido == true) {
            $_SESSION['message'] = (Object) [
                'type'=>'info',
                'message' => 'Apelido editado com sucesso!'
            ];
        }

        $usuario->setSenha(""); //remove a senha do usuário para ser passado para a sessão.
        $_SESSION['auth'] = serialize($usuario);
    }
    
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

atualizarApelido($usuarioDao);