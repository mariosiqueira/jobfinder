<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\ServicoCategoriaDaoMysql;
use App\VO\ServicoCategoria;
use App\VO\Categoria;
use App\Dao\CategoriaDaoMysql;

class ServicoCategoriaDaoCenario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrar(ServicoCategoria $servicoCategoria)
    {
        $servicoCategoriaDaoMysql = new ServicoCategoriaDaoMysql($this->pdo);

        return $servicoCategoriaDaoMysql->salvar($servicoCategoria);
    }

    public function buscarPeloIdDaCategoria($categoriaId)
    {
        $servicoCategoriaDaoMysql = new ServicoCategoriaDaoMysql($this->pdo);
        
        return $servicoCategoriaDaoMysql->buscarPeloIdDaCategoria($categoriaId);
    }

}