<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use App\Config\Conexao; //import do pdo para utilizar na classe ServicoDaoMysql
use App\Dao\UsuarioDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET
use App\Dao\ServicoDaoMysql; //Import da classe ServicoDaoMysql para buscar o serviço pelo id recebido na query do GET
use App\Dao\ServicoCategoriaDaoMysql; 
use App\Dao\AvaliacaoDaoMysql; 

use App\VO\Servico;

$pdo = Conexao::getInstance();

$data = json_decode(file_get_contents("php://input"),true); //pegando o POST do axios

$userId = intval($data['id']);

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuarioSessao = $usuarioDao->buscarPeloId($userId);
$avaliacaoDao = new AvaliacaoDaoMysql($pdo);

if(!$usuarioSessao){
    echo json_encode(array('status' => false));
}
else {
    $dataAvaliacao = $avaliacaoDao->buscarAvaliacoesUsuario($usuarioSessao->getId());

    $avaliacoes = [];
    $somaAvaliacoes = 0; //variavel pra pegar a soma de todas as avaliações deste usuario

    if ($dataAvaliacao) {
        foreach($dataAvaliacao as $ava) {
            $aux = [];
            $aux['id'] = $ava['id'];
            $aux['avaliacao'] = $ava['avaliacao'];
            $aux['comentario'] = $ava['comentario'];
            $aux['usuario_id'] = $ava['usuario_id'];
            $aux['avaliador_id'] = $usuarioDao->buscarPeloId($ava['avaliador_id']);
        
            $avaliacoes[] = $aux;
        }
    }

    $jsonAvaliacoes = json_encode(array('status'=>true, 'avaliacoes'=>$avaliacoes));
    echo $jsonAvaliacoes;
}