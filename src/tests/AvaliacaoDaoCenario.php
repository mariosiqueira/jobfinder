<?php

namespace App\Tests;

use App\Config\Conexao;
use App\VO\Avaliacao;
use App\Dao\AvaliacaoDaoMysql;

class AvaliacaoDaoCenario
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrar(Avaliacao $avaliacao)
    {
        $avaliacaoDaoMysql = new AvaliacaoDaoMysql($this->pdo);

        return $avaliacaoDaoMysql->salvar($avaliacao);
    }

    public function buscarAvaliacaoUsuario($idUsuario) {
        $avaliacaoDaoMysql = new AvaliacaoDaoMysql($this->pdo);

        return $avaliacaoDaoMysql->buscarAvaliacoesUsuario($idUsuario);
    }

}