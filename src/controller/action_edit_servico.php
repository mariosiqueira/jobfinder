<?php
use App\Config\Conexao;//import do pdo
use App\Dao\CategoriaDaoMysql; 
use App\Dao\ServicoDaoMysql; //import da classe ServicoDaoMysql para salvar a atualização do serviço
use App\Dao\ServicoCategoriaDaoMysql; 

use App\VO\ServicoCategoria; 

$pdo = Conexao::getInstance();

$servicoDao = new ServicoDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);
$categoriaDao = new CategoriaDaoMysql($pdo);

function atualizarServico($servicoDao, $servicoCategoriaDao, $categoriaDao) {
    $servicoId = intval(filter_input(INPUT_POST, 'servico_id'));
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $enderecoServico = filter_input(INPUT_POST, 'endereco_servico', FILTER_SANITIZE_STRING);
    $valor = floatval(filter_input(INPUT_POST, 'valor'));
    $categorias = $_POST['categoria'];

    $servicoCategorias = $servicoCategoriaDao->buscarPeloIdDoServico($servicoId);
    foreach ($servicoCategorias as $sc) {
        $servicoCategoriaDao->deletarCategoriaServico($sc->getServicoId());
    }

    $categoriasDoServico = [];
    foreach($categorias as $c) {
        $categoriasDoServico[] = $categoriaDao->buscarPeloId($c);
    }
        
    //Recuperando todos os dados do serviço buscado pelo id porque no formulário não encaminhou o usuario_id e o id do serviço.
    $servicoAtualizado = $servicoDao->buscarPeloId($servicoId);

    foreach($categoriasDoServico as $cs) {
        $servicoCategoria = new ServicoCategoria();
        $servicoCategoria->setServicoId($servicoId);
        $servicoCategoria->setCategoriaId($cs->getId());
        $servicoCategoriaDao->salvar($servicoCategoria);
    }

    if($servicoAtualizado == false) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao atualizar o serviço!'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
        exit();
    }
   
    //Setando os campos atualizados que vieram do formulário
    $servicoAtualizado->setTitulo($titulo);
    $servicoAtualizado->setDescricao($descricao);
    $servicoAtualizado->setEnderecoServico($enderecoServico);
    $servicoAtualizado->setValor($valor);

    $atualizou = $servicoDao->atualizar($servicoAtualizado);
    if($atualizou == true) {
        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Serviço editado com sucesso!'
        ];
    } else {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao atualizar o serviço!'
        ];
    }
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
    exit();
}

atualizarServico($servicoDao, $servicoCategoriaDao, $categoriaDao);