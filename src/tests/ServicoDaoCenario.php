<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\ServicoDaoMysql;
use App\VO\Servico;

class ServicoDaoCenario
{
    public function cadastrar(Servico $servico)
    {
        $servicoDaoMysql = new ServicoDaoMysql(Conexao::getInstance());

        return $servicoDaoMysql->salvar($servico);
    }
}