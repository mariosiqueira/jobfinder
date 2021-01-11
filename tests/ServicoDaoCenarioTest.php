<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Servico;
use App\Tests\ServicoDaoCenario;

final class ServicoDaoCenarioTest extends TestCase
{
    public function testSalvaServico(): void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de salvar serviço para nao persistir no banco.'
        );

        $servico = new Servico();
        $servico->setTitulo('servico test');
        $servico->setDescricao('descrição serviço teste');
        $servico->setEnderecoServico('endereço teste');
        $servico->setValor(100.53);
        $servico->setStatus("aberto");
        $servico->setUsuarioId(1); //id de um usuario cadastrado no banco

        $dao = new ServicoDaoCenario();
        $this->assertNotNull($dao->cadastrar($servico)); //É esperado que o serviço seja criado com sucesso
    }

    public function testSalvaServicoErro(): void
    {
        $servico = new Servico();
        $servico->setTitulo('servico test');
        $servico->setDescricao('descrição serviço teste');
        $servico->setEnderecoServico('endereço teste');
        $servico->setValor(100.53);
        $servico->setStatus("aberto");
        //$servico->setUsuarioId(2); //id de um usuario cadastrado no banco

        $dao = new ServicoDaoCenario();
        $this->assertNull($dao->cadastrar($servico)); //É esperado null pq não foi passado o id do usuario que criou o serviço 
    }
}