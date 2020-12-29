<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //import do pdo para usar nas classes ServicoDaoMysql, CategoriaDaoMysql e ServicoCategoriaDaoMysql
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoDaoMysql.php'; //import da classe ServicoDaoMysql para cadastrar um serviço
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/CategoriaDaoMysql.php'; //import da classe CategoriaDaoMysql para poder buscar a categoria passado por post no formulário
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/ServicoCategoriaDaoMysql.php'; //import da classe ServicoCategoriaDaoMysql para associar as categorias buscadas ao serviço cadastrado

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
    $nomesDasCategoriasDoServico = $_POST['categoria'];
    $categoriasDoServico = [];
    foreach($nomesDasCategoriasDoServico as $nomeDaCategoriaDoServico) {
        $categoriasDoServico[] = $categoriaDao->buscarPeloNome($nomeDaCategoriaDoServico);
    }
    $servico = new Servico();
    $servico->setTitulo($titulo);
    $servico->setDescricao($descricao);
    $servico->setEnderecoServico($enderecoServico);
    $servico->setValor($valor);
    $servico->setUsuarioId($usuarioId);
    $servico->setStatus("aberto");

    $servico = $servicoDao->salvar($servico);

    foreach($categoriasDoServico as $categoria) {
        $servicoCategoria = new ServicoCategoria();
        $servicoCategoria->setServicoId($servico->getId());
        $servicoCategoria->setCategoriaId($categoria[0]->getId());
        $servicoCategoriaDao->salvar($servicoCategoria);
    }
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/profile');
}

cadastrarServico($servicoDao, $categoriaDao, $servicoCategoriaDao);