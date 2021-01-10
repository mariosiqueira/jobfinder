<?php
use App\Config\Conexao;//importa o PDO para utilizar na classe UsuarioDaoMysql
use App\Dao\UsuarioDaoMysql; //Deleta o usuário do banco de dados
use App\Dao\ServicoDaoMysql; //Deleta os serviços do usuário no banco de dados
use App\Dao\ServicoCategoriaDaoMysql; //Deleta as categorias associadas aos serviços do usuário no banco de dados
use App\Dao\UsuarioServicoDaoMysql; //Deleta a associação entre um usuário e um serviço
use App\Dao\AvaliacaoDaoMysql; // Deleta as avaliações feitas ao/pelo usuário que vai ser removido
use App\Dao\MensagemDaoMysql; //Apaga as ocorrências de mensagens que foram trocadas por um usuário que vai ser removido

$pdo = Conexao::getInstance();

$usuarioDao = new UsuarioDaoMysql($pdo);
$servicoDao = new ServicoDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);
$usuarioServicoDao = new UsuarioServicoDaoMysql($pdo);
$avaliacaoDao = new AvaliacaoDaoMysql($pdo);
$mensagemDao = new MensagemDaoMysql($pdo);

// #################### Funções auxiliares à função principal deletarUsuario ####################
function deletarCategoriasAssociadasAUmServico($servicoCategoriaDao, $arrayServicos) {
    foreach($arrayServicos as $servico) {
        $servicoCategoriaDao->deletar($servico->getId());
    }
}

function deletarTodasAssociacoesUsuarioServico($usuarioServicoDao, $arrayServicos) {
    foreach($arrayServicos as $servico) {
        $usuarioServicoDao->deletarPeloServicoId($servico->getId());
    }
}

function deletarAvaliacoesDoUsuario($avaliacaoDao, $id) {
    $avaliacaoDao->deletarAvaliacaoPeloUsuarioId($id);
    $avaliacaoDao->deletarAvaliacaoPeloAvaliadorId($id);
}

function deletarMensagensDoUsuario($mensagemDao, $id) {
    $mensagemDao->deletarMensagemPeloContratanteId($id);
    $mensagemDao->deletarMensagemPeloContratadoId($id);
}

function deletarServicos($servicoDao, $arrayServicos) {
    foreach($arrayServicos as $servico) {
        $servicoDao->deletar($servico->getId());
    }
}

//Método exclusivo para o caso do usuário que será excluído não ter cadastrado serviço, mas apenas se candidatado.
function deletarContratadoDeServicos($usuarioServicoDao, $contratadoId) {
    $arrayUsuarioServicos = $usuarioServicoDao->buscarPeloContratadoId($contratadoId); //Vai receber todos os objetos de usuarioServico para o contratado ser desassociado do servico.
    foreach($arrayUsuarioServicos as $usuarioServico) {
        $usuarioServico->setContratadoId(null); //Ao invés de deletar por completo esse serviço, apenas atualizamos o id do contratado para null, pois este terá sua conta excluída.
        $usuarioServicoDao->atualizar($usuarioServico);
    }
}

// #################### Funções auxiliares à função principal deletarUsuario ####################

/**
 * A função a seguir checa se usuário digitou uma senha e verifica se a senha digitada condiz com a senha do id dele.
 * Depois é necessário apagar todas as categorias associadas aos serviços que o usuário cadastrou bem como o serviço
 * cadastrado por ele. Depois serão apagados todas as associações de empregos que o usuário se interessou por trabalhar.
 * Serão apagadas todas as mensagens trocadas por esse usuário e, por fim, o próprio usuário será removido. 
 **/

function deletarUsuario($usuarioDao, $servicoDao, $servicoCategoriaDao, $usuarioServicoDao, $avaliacaoDao, $mensagemDao) {
    $senha = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
    $usuario = unserialize($_SESSION['auth']);
    $usuario = $usuarioDao->buscarPeloId($usuario->getId());
    if($senha && $senha == $usuario->getSenha()) {
        $arrayServicos = $servicoDao->buscarServicoPeloIdDoUsuario($usuario->getId());

        if($arrayServicos == null) { //Se o usuário não cadastrou serviço então não é preciso deletar as categorias e o serviço que ele se candidatou.
            deletarContratadoDeServicos($usuarioServicoDao, $usuario->getId());
            deletarAvaliacoesDoUsuario($avaliacaoDao, $usuario->getId());
            deletarMensagensDoUsuario($mensagemDao, $usuario->getId());
            $usuarioDao->deletar($usuario->getId());
            
        } else {
            deletarCategoriasAssociadasAUmServico($servicoCategoriaDao, $arrayServicos);
            deletarTodasAssociacoesUsuarioServico($usuarioServicoDao, $arrayServicos);
            deletarAvaliacoesDoUsuario($avaliacaoDao, $usuario->getId());
            deletarMensagensDoUsuario($mensagemDao, $usuario->getId());
            deletarServicos($servicoDao, $arrayServicos);
            $usuarioDao->deletar($usuario->getId());

        }
        //Removendo uma foto que não seja a default-user-img.jpg
        if($usuario->getFotoPerfil() != "default-user-img.jpg") {
            unlink($_SERVER['DOCUMENT_ROOT'].'/jobfinder/files/'.$usuario->getFotoPerfil());
        }

        $_SESSION['auth'] = null;
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/index.php');
        exit();
        
    } else {
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
        exit();
    }
}

deletarUsuario($usuarioDao, $servicoDao, $servicoCategoriaDao, $usuarioServicoDao, $avaliacaoDao, $mensagemDao);