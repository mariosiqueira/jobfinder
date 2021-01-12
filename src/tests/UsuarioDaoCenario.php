<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\UsuarioDaoMysql;
use App\VO\Usuario;

class UsuarioDaoCenario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrar(Usuario $usuario)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);

        return $usuarioDaoMysql->salvar($usuario);
    }

    public function logar($email, $senha)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);

        $aux = $usuarioDaoMysql->buscarPeloEmail($email);

        if($aux) { //Se encontrou usuário com o e-mail fornecido
            return $aux->getSenha() == $senha ? true : false;
        } else {
            return null;
        } 
    }

    public function buscarUsuarioPeloEmail($email) 
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);

        $aux = $usuarioDaoMysql->buscarPeloEmail($email);

        return $aux == false ? null : $aux;
    }

    public function buscarUsuarioPeloId($id) 
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);

        $aux = $usuarioDaoMysql->buscarPeloId($id);

        return $aux == false ? null : $aux;
    }

    public function atualizar(Usuario $usuario) 
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);
        $aux = $usuarioDaoMysql->buscarPeloId($usuario->getId());
        if($aux == false) {
            return false;
        }

        return $usuarioDaoMysql->atualizar($usuario);
    }
}