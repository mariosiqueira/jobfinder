<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\UsuarioDaoMysql;
use App\VO\Usuario;

class UsuarioDaoCenario
{
    public function cadastrar(Usuario $usuario)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql(Conexao::getInstance());

        $aux = $usuarioDaoMysql->salvar($usuario);

        return $aux ? true : false;
    }

    // public function logar($email, $senha)
    // {
    //     $usuarioDaoMysql = new UsuarioDaoMysql(Conexao::getInstance());

    //     $aux = $usuarioDaoMysql->buscarPeloEmail($email);

    //     return $aux->getSenha() == $senha ? true : false;
    // }
}