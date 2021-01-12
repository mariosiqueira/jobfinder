<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\UsuarioDaoMysql;
use App\VO\Usuario;
use App\Dao\ServicoDaoMysql;
use App\VO\Servico;

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
        $aux->setNome($usuario->getNome());
        $aux->setApelido($usuario->getApelido());
        $aux->setTelefone($usuario->getTelefone());
        $aux->setSenha($usuario->getSenha());
        $aux->setFotoPerfil($usuario->getFotoPerfil());

        return $usuarioDaoMysql->atualizar($aux);
    }

    public function atualizarApelido($id, $apelido) 
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);
        $aux = $usuarioDaoMysql->buscarPeloId($id);
        if($aux == false) {
            return false;
        }
        if($apelido) {
            $aux->setApelido($apelido);
            return $usuarioDaoMysql->atualizar($aux);
        }
        return false;
    }

    public function atualizarNomeETelefone($id, $novoNome, $novoTelefone) 
    {
        $usuarioDaoMysql = new UsuarioDaoMysql($this->pdo);
        $aux = $usuarioDaoMysql->buscarPeloId($id);
        if($aux == false) {
            return false;
        }
        if($novoNome && $novoTelefone) {
            $aux->setNome($novoNome);
            $aux->setTelefone($novoTelefone);
            return $usuarioDaoMysql->atualizar($aux);
        }
        return false;
    }
}