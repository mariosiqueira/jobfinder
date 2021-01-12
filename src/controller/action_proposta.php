<?php
use App\Config\Conexao;//Importa o PDO
use App\Dao\MensagemDaoMysql; //Importa MensagemDaoMysql para o CRUD

use App\VO\Mensagem;

$pdo = Conexao::getInstance();

$mensagemDaoMysql = new MensagemDaoMysql($pdo);

$contratante_id = filter_input(INPUT_POST, 'contratante_id', FILTER_SANITIZE_STRING);
$contratado_id = filter_input(INPUT_POST, 'contratado_id', FILTER_SANITIZE_STRING);
$mensagem = filter_input(INPUT_POST,'mensagem', FILTER_SANITIZE_STRING);


if($contratante_id && $contratado_id && $mensagem) {

    $novaProposta = new Mensagem();
    $novaProposta->setContratanteId($contratante_id);
    $novaProposta->setContratadoId($contratado_id);
    $novaProposta->setMensagem($mensagem);

    $propostaSalva = $mensagemDaoMysql->salvar($novaProposta);
    if(!is_null($propostaSalva)) {

        $_SESSION['message'] = (Object) [
            'type'=>'info',
            'message' => 'Sua proposta foi registrada com sucesso!'
        ];
    }

} else {
    $_SESSION['message'] = (Object) [
        'type'=>'error',
        'message' => 'Ocorreu um erro inesperado no registro da proposta!'
    ];
}

header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/jobs');
exit();