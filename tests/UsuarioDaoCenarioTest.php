<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Usuario;
use App\Tests\UsuarioDaoCenario;

final class UsuarioDaoCenarioTest extends TestCase
{
    public function testFazerCadastro(): void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de salvar usuário para nao persistir no banco.'
        );

        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //o e-mail deve ser unique
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertNotNull($dao->cadastrar($usuario)); //É esperado que nao retorne null
    }

    public function testFazerCadastroEmailExistente(): void
    {
        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //usando e-mail já existente
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertNull($dao->cadastrar($usuario)); //É esperado que retorne null porque o e-mail já está cadastrado
    }

    public function testLogarCorretamente(): void
    {
        $email = "usuario@email.com";
        $senha = md5("12345");

        $dao = new UsuarioDaoCenario();
        $this->assertTrue($dao->logar($email, $senha));
    }

    public function testLogarSenhaIncorreta(): void
    {
        $email = "usuario@email.com";
        $senha = md5("senhaerrada");

        $dao = new UsuarioDaoCenario();
        $this->assertFalse($dao->logar($email, $senha)); //Deve retornar false caso seja passado uma senha incorreta
    }

    public function testLogarEmailIncorretoOuInexistente(): void
    {
        $email = "usuario@email.co";
        $senha = md5("12345");

        $dao = new UsuarioDaoCenario();
        $this->assertNull($dao->logar($email, $senha)); //Deve retornar null caso seja passado um e-mail incorreto ou um e-mail de usuario que não seja cadastrado
    }

    public function testBuscarUsuarioPeloEmailCorretamente(): void
    {
        $email = "usuario@email.com";

        $dao = new UsuarioDaoCenario();
        $this->assertNotNull($dao->buscarUsuarioPeloEmail($email)); //Deve retornar not null caso exista um usuário com o e-mail cadastrado
    }

    public function testBuscarUsuarioPeloEmailIncorretamente(): void
    {
        $email = "usuario@email.co";

        $dao = new UsuarioDaoCenario();
        $this->assertNull($dao->buscarUsuarioPeloEmail($email)); //Deve retornar not null caso exista um usuário com o e-mail cadastrado
    }

    public function testAtualizarUsuarioComIdInexistente(): void
    {
        $usuario = new Usuario();
        $usuario->setId(-1); //Id inválido
        $usuario->setNome('novo nome');
        $usuario->setApelido('novo apelido');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //usando e-mail já existente
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertFalse($dao->atualizar($usuario)); //Um valor falso é esperado atribuindo-se um id inexistente no banco de dados
    }
    public function testAtualizarUsuarioComIdExistente(): void
    {
        $usuario = new Usuario();
        $usuario->setId(40); //É necessário passar um id válido para poder atualizar o usuário
        $usuario->setNome('novo nome');
        $usuario->setApelido('novo apelido');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //usando e-mail já existente
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertTrue($dao->atualizar($usuario)); //Um valor true será esperado caso o id seja válido
    }

    public function testAtualizarApelidoComIdExistenteEApelidoPreenchido(): void
    {
        $id = 40; //É necessário passar um id válido para poder atualizar o usuário
        $apelido = 'novo apelido';

        $dao = new UsuarioDaoCenario();
        $this->assertTrue($dao->atualizarApelido($id, $apelido)); //Um valor true será esperado caso o id seja válido e o apelido seja preenchido
    }

    public function testAtualizarApelidoComIdInexistente(): void
    {
        $id = -1; //É necessário passar um id válido para poder atualizar o usuário
        $apelido = 'novo apelido';

        $dao = new UsuarioDaoCenario();
        $this->assertFalse($dao->atualizarApelido($id, $apelido)); //Um valor false será esperado
    }

    public function testAtualizarApelidoComApelidoVazio(): void
    {
        $id = 40; //É necessário passar um id válido para poder atualizar o usuário
        $apelido = '';
        $dao = new UsuarioDaoCenario();
        $this->assertFalse($dao->atualizarApelido($id, $apelido)); //Um valor false será esperado
    }
}