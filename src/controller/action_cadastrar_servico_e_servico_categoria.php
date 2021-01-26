<?php

use App\Config\Conexao; //import do pdo para usar nas classes ServicoDaoMysql, CategoriaDaoMysql e ServicoCategoriaDaoMysql

use App\Dao\ServicoDaoMysql; //import da classe ServicoDaoMysql para cadastrar um serviço
use App\Dao\CategoriaDaoMysql; //import da classe CategoriaDaoMysql para poder buscar a categoria passado por post no formulário
use App\Dao\ServicoCategoriaDaoMysql; //import da classe ServicoCategoriaDaoMysql para associar as categorias buscadas ao serviço cadastrado
use App\VO\Servico;
use App\VO\ServicoCategoria;

$pdo = Conexao::getInstance();

$servicoDao = new ServicoDaoMysql($pdo);
$categoriaDao = new CategoriaDaoMysql($pdo);
$servicoCategoriaDao = new ServicoCategoriaDaoMysql($pdo);

/**
 * O método cadastrarServico recebe dados por POST. Um dos dados recebidos é o nome das categorias do serviço cadastrado
 * que será usado no método buscarPeloNome para recuperar os ids dessas categorias. Após receber esses ids, salva-se o serviço,
 * depois associa-se cada id da categoria ao serviço pelo método salvar da classe ServicoCategoriaDaoMysql
 */
function cadastrarServico($servicoDao, $categoriaDao, $servicoCategoriaDao) {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $enderecoServico = filter_input(INPUT_POST, 'endereco_servico', FILTER_SANITIZE_STRING);
    $valor = floatval(filter_input(INPUT_POST, 'valor'));
    $usuarioId = intval(filter_input(INPUT_POST, 'usuario_id'));
    $idsDasCategoriasDoServico = $_POST['categoria'];
    $categoriasDoServico = [];
    foreach($idsDasCategoriasDoServico as $idDaCategoriaDoServico) {
        $categoriasDoServico[] = $categoriaDao->buscarPeloId($idDaCategoriaDoServico);
    }
    $servico = new Servico();
    $servico->setTitulo($titulo);
    $servico->setDescricao($descricao);
    $servico->setEnderecoServico($enderecoServico);
    $servico->setValor($valor);
    $servico->setUsuarioId($usuarioId);
    $servico->setStatus("aberto");

    $servico = $servicoDao->salvar($servico);

    if (!is_null($servico)) {
        
        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Serviço cadastrado com sucesso!'
        ];
    
        foreach($categoriasDoServico as $categoria) {
            $servicoCategoria = new ServicoCategoria();
            $servicoCategoria->setServicoId($servico->getId());
            $servicoCategoria->setCategoriaId($categoria->getId());
            $servicoCategoriaDao->salvar($servicoCategoria);
        }
        
    } else{
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Aconteceu um erro inesperado!'
        ];
    }
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
    exit();
}

cadastrarServico($servicoDao, $categoriaDao, $servicoCategoriaDao);