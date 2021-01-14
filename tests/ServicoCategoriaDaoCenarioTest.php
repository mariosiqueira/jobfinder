<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\ServicoCategoria;
use App\Tests\ServicoCategoriaDaoCenario;

final class ServicoCategoriaDaoCenarioTest extends TestCase
{

    public function testSalvarServicoCategoria(): void
    {
        $this->markTestIncomplete(
            'Ignorando o test de salvar servicoCategoria para nao persistir no banco.'
        );

        $servicoId = 1; //Deve-se passar um servico com id válido
        $categoriaId = 1; //Deve-se passar um id de categoria válida no banco de dados
        $servicoCategoria = new ServicoCategoria();
        
        $servicoCategoria->setServicoId($servicoId);
        $servicoCategoria->setCategoriaId($categoriaId);

        $dao = new ServicoCategoriaDaoCenario();
        $this->assertNotNull($dao->cadastrar($servicoCategoria)); //É esperado um valor não nulo ao associar um serviço a uma categoria
    }

    public function testSalvarServicoCategoriaSemCategoriaAssociada(): void
    {
        $servicoId = 1; //Deve-se passar um servico com id válido
        $servicoCategoria = new ServicoCategoria();
        
        $servicoCategoria->setServicoId($servicoId);

        $dao = new ServicoCategoriaDaoCenario();
        $this->assertNull($dao->cadastrar($servicoCategoria)); //É esperado um valor nulo ao associar um serviço a uma categoria
    }

    public function testbuscarPeloIdDaCategoria(): void
    {
        $categoriaId = 1; //Id com categoria válida
        $dao = new ServicoCategoriaDaoCenario();

        $this->assertNotNull($dao->buscarPeloIdDaCategoria($categoriaId)); //É esperado que a busca retorne um valor não nulo.
    }

    public function testbuscarPeloIdDaCategoriaErro(): void
    {
        $categoriaId = -1; //Id com categoria inválida
        $dao = new ServicoCategoriaDaoCenario();

        $this->assertFalse($dao->buscarPeloIdDaCategoria($categoriaId)); //É esperado que a busca retorne false.
    }

}