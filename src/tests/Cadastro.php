<?php


namespace App\Tests;

use App\Dao\UsuarioDaoMysql;
use App\VO\Usuario;

class Cadastro
{
    public function cadastrar(Usuario $usuario)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql();

        $aux = $usuarioDaoMysql->salvar($usuario);

        return $aux ? true : false;
    }
}