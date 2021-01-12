<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\ServicoDaoMysql;
use App\VO\Servico;

class ServicoDaoCenario
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrar(Servico $servico)
    {
        $servicoDaoMysql = new ServicoDaoMysql($this->pdo);

        return $servicoDaoMysql->salvar($servico);
    }

    public function atualizar(Servico $servico)
    {
        $servicoDaoMysql = new ServicoDaoMysql($this->pdo);

        return $servicoDaoMysql->atualizar($servico);
    }

    public function deletar(int $id)
    {
        $servicoDaoMysql = new ServicoDaoMysql($this->pdo);

        return $servicoDaoMysql->deletar($id);
    }

}