<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Categoria;
use App\Tests\CategoriaDaoCenario;

final class CategoriaDaoCenarioTest extends TestCase
{
    //O único método utilizado em CategoriaDaoMysql é a busca de todas as categorias
    public function testBuscarTodasAsCateogiras(): void
    {
        $dao = new CategoriaDaoCenario();
        $this->assertNotNull($dao->buscarTodas()); //É esperado que a busca retorne as categorias salvas no banco.
    }

}