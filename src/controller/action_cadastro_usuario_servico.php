<?php
use App\Config\Conexao; //importa o PDO
use App\Dao\UsuarioServicoDaoMysql;
use App\Dao\ServicoDaoMysql;
use App\Dao\AvaliacaoDaoMysql;

use App\VO\Avaliacao;
use App\VO\UsuarioServico;

$pdo = Conexao::getInstance();

$usuarioServicoDao = new UsuarioServicoDaoMysql($pdo);

$servicoDao = new ServicoDaoMysql($pdo);
$avaliacaoDao = new AvaliacaoDaoMysql($pdo);

function cadastrarUsuarioServico($usuarioServicoDao, $avaliacaoDao, $servicoDao) {

    // var_dump($_POST);
    $data_finalizacao_servico = date('d/m/Y');
    $metodo_pagamento = filter_input(INPUT_POST, 'metodo_pagamento');
    $valor_final = filter_input(INPUT_POST, 'valor_final');
    $servico_id = intval(filter_input(INPUT_POST, 'servico_id'));
    $contratante_id = intval(filter_input(INPUT_POST, 'contratante_id'));
    $contratado_id = intval(filter_input(INPUT_POST, 'contratado_id'));

    $valorAvaliacao = intval(filter_input(INPUT_POST, 'rating'));
    $comentario = filter_input(INPUT_POST, 'comentario');

    $avaliacao = new Avaliacao();
    $avaliacao->setAvaliacao($valorAvaliacao);
    $avaliacao->setComentario($comentario);
    $avaliacao->setUserId($contratado_id);
    $avaliacao->setAvaliadorId($contratante_id);

    $usuarioServico = new UsuarioServico();
    $usuarioServico->setDataFinalizacaoServico($data_finalizacao_servico);
    $usuarioServico->setMetodoPagamento($metodo_pagamento);
    $usuarioServico->setValorFinal($valor_final);
    $usuarioServico->setServicoId($servico_id);
    $usuarioServico->setContratanteId($contratante_id);
    $usuarioServico->setContratadoId($contratado_id);
    $servico = $servicoDao->buscarPeloId($servico_id);
    $servico->setStatus("finalizado");
    $servicoFinalizado = $servicoDao->atualizar($servico);

    session_start();
    if($servicoFinalizado == false) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao finalizar o serviço'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
        exit();
    }
    
    $resultadoSalvarUsuarioServico = $usuarioServicoDao->salvar($usuarioServico);
    
    if(is_null($resultadoSalvarUsuarioServico)) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao finalizar o serviço'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
        exit();
    }

    $avaliacaoDao->salvar($avaliacao);
    if(is_null($avaliacao)) {
        $_SESSION['message'] = (Object) [
            'type'=>'error',
            'message' => 'Ocorreu um erro inesperado ao finalizar o serviço'
        ];
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
        exit();
    }

    $_SESSION['message'] = (Object) [
        'type'=>'info',
        'message' => 'O serviço foi finalizado com sucesso!'
    ];

    header('Location:http://'.$_SERVER['HTTP_HOST'].'/profile');
    exit();
}

cadastrarUsuarioServico($usuarioServicoDao, $avaliacaoDao, $servicoDao);