<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Usuario;
use App\Tests\UsuarioDaoCenario;

final class UsuarioDaoCenarioTest extends TestCase
{
    public function testFazerCadastro(): void
    {
        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com');
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertNotNull($dao->cadastrar($usuario)); //É esperado que nao retorne null
    }
}