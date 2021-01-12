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

    public function atualizar(int $id, array $novoServico)
    {
        $servicoDaoMysql = new ServicoDaoMysql($this->pdo);
        $servico = $servicoDaoMysql->buscarPeloId($id);

        if($servico){
            array_key_exists("titulo", $novoServico) ? $servico->setTitulo($novoServico['titulo']) : null;
            array_key_exists("descricao", $novoServico) ? $servico->setDescricao($novoServico['descricao']) : null;
            array_key_exists("enderecoServico", $novoServico) ? $servico->setEnderecoServico($novoServico['enderecoServico']) : null;
            array_key_exists("valor", $novoServico) ? $servico->setvalor($novoServico['valor']) : null;
            array_key_exists("dataPostagem", $novoServico) ? $servico->setDataPostagem($novoServico['dataPostagem']) : null;
            array_key_exists("status", $novoServico) ? $servico->setStatus($novoServico['status']) : null;
    
            return $servicoDaoMysql->atualizar($servico);
        }
        return false;
    }

    public function deletar(int $id)
    {
        $servicoDaoMysql = new ServicoDaoMysql($this->pdo);

        return $servicoDaoMysql->deletar($id);
    }

}