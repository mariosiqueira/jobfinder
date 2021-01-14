<?php

namespace App\Tests;

use App\Config\Conexao;
use App\VO\Categoria;
use App\Dao\CategoriaDaoMysql;

class CategoriaDaoCenario
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function buscarTodas()
    {
        $categoriaDaoMysql = new CategoriaDaoMysql($this->pdo);

        return $categoriaDaoMysql->buscarTodas();
    }

}