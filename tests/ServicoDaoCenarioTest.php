<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Servico;
use App\Tests\ServicoDaoCenario;

final class ServicoDaoCenarioTest extends TestCase
{
    public function testSalvatServico(): void
    {
        $servico = new Servico();
        $servico->setTitulo('servico test');
        $servico->setDescricao('descrição serviço teste');
        $servico->setEnderecoServico('endereço teste');
        $servico->setDataPostagem(date('Y-m-d'));
        $servico->setValor(0);
        $servico->setValor("100");
        $servico->setStatus("aberto");
        //$servico->setUsuarioId(2); //id de um usuario cadastrado no banco

        $dao = new ServicoDaoCenario();
        $this->assertNull($dao->cadastrar($servico)); //É esperado null pq não foi passado o id do usuario que criou o serviço 
    }
}
