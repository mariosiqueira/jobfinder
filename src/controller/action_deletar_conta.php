<?php
use App\Config\Conexao;//importa o PDO para utilizar na classe UsuarioDaoMysql
use App\Dao\UsuarioDaoMysql; //Deleta o usuário do banco de dados
use App\Dao\ServicoDaoMysql; //Deleta os serviços do usuário no banco de dados
use App\Dao\UsuarioServicoDaoMysql; //Deleta a associação entre um usuário e um serviço

$pdo = Conexao::getInstance();

$usuarioDao = new UsuarioDaoMysql($pdo);
$servicoDao = new ServicoDaoMysql($pdo);
$usuarioServicoDao = new UsuarioServicoDaoMysql($pdo);

// #################### Funções auxiliar à função principal deletarUsuario ####################

//Método exclusivo para o caso do usuário que será excluído ter se candidatado em algum serviço.
function deletarContratadoDeServicos($usuarioServicoDao, $contratadoId) {
    $arrayUsuarioServicos = $usuarioServicoDao->buscarPeloContratadoId($contratadoId); //Vai receber todos os objetos de usuarioServico para o contratado ser desassociado do servico.
    if(!is_null($arrayUsuarioServicos)) {
        foreach($arrayUsuarioServicos as $usuarioServico) {
            $usuarioServico->setContratadoId(null); //Ao invés de deletar por completo esse serviço, apenas atualizamos o id do contratado para null, pois este terá sua conta excluída.
            $usuarioServicoDao->atualizar($usuarioServico);
        }
        return true;
    }
    return false;
}

// #################### Funções auxiliar à função principal deletarUsuario ####################

/**
 * A função a seguir checa se usuário digitou uma senha e verifica se a senha digitada condiz com a senha do id dele.
 * Em seguida é feito uma verificação se o usuário se candidatou a algum serviço e apaga a coluna de contratado_id da tabela
 * usuario_servico. Por fim, o usuário é apagado e todas as suas relações com outras tabelas também. 
 **/

function deletarUsuario($usuarioDao, $servicoDao, $usuarioServicoDao) {
    $senha = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
    $usuario = unserialize($_SESSION['auth']);
    $usuario = $usuarioDao->buscarPeloId($usuario->getId());

    $deletou = false;

    if($senha && $senha == $usuario->getSenha()) {

        deletarContratadoDeServicos($usuarioServicoDao, $usuario->getId());
        $deletou = $usuarioDao->deletar($usuario->getId());

        //Removendo uma foto que não seja a default-user-img.jpg
        if($usuario->getFotoPerfil() != "default-user-img.jpg") {
            unlink($_SERVER['DOCUMENT_ROOT'].'/jobfinder/src/files/'.$usuario->getFotoPerfil());
        }

        $_SESSION['auth'] = null;

        if ($deletou == true) {
        
            $_SESSION['message'] = (Object) [
                'type'=>'info',
                'message' => 'Conta deletada com sucesso.'
            ];
        } else {
            $_SESSION['message'] = (Object) [
                'type'=>'error',
                'message' => 'Ocorreu um erro inesperado ao remover sua conta. Contate o administrador do sistema.'
            ];
        }

        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/index.php');
        exit();
        
    } else {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'A senha digita está incorreta.'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
        exit();
    }
}

deletarUsuario($usuarioDao, $servicoDao, $usuarioServicoDao);