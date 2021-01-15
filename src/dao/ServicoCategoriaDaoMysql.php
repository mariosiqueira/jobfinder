<?php
namespace App\Dao;
use App\Dao\ServicoDaoMysql;
use App\Dao\CategoriaDaoMysql;
use App\VO\ServicoCategoria;
use App\VO\ServicoCategoriaDao;
use PDO;

class ServicoCategoriaDaoMysql implements ServicoCategoriaDao {

    private $pdo;
    private $servicoDaoMysql;
    private $categoriaDaoMysql;

    /**
     * O PDO vai ser passado por parâmetro no arquivo que 
     * precisar instanciar essa classe ServicoCategoriaDaoMysql.
     */

    public function __construct(PDO $driver){
        $this->pdo = $driver;
        $this->servicoDaoMysql = new ServicoDaoMysql($this->pdo);
        $this->categoriaDaoMysql = new CategoriaDaoMysql($this->pdo);
    }

    /**
     * Os métodos concretos a seguir são obrigatórios para esta classe 
     * funcionar e foram implementados da interface ServicoCategoriaDao 
     * que está no arquivo ServicoCategoriaDao.php da pasta vo.
     **/

    public function salvar(ServicoCategoria $servicoCategoria) {
        $sql = $this->pdo->prepare("INSERT INTO servico_categorias (servico_id, categoria_id) values (:servico_id, :categoria_id)");
        $sql->bindValue(':servico_id', $servicoCategoria->getServicoId());
        $sql->bindValue(':categoria_id', $servicoCategoria->getCategoriaId());
        if($sql->execute()) {
            return $servicoCategoria;
        }
        return null;

    }

    public function buscarTodos() {
        $arrayServicoCategorias = [];

        $sql = $this->pdo->query("SELECT * FROM servico_categorias");
        if($sql->rowCount() > 0) {
            $arrayDadosServicoCategorias = $sql->fetchAll();

            foreach($arrayDadosServicoCategorias as $dadoServicoCategoria ) {
                $servicoCategoria = new ServicoCategoria();
                $servicoCategoria->setServicoId($dadoServicoCategoria['servico_id']);
                $servicoCategoria->setCategoriaId($dadoServicoCategoria['categoria_id']);
                $arrayServicoCategorias[] = $servicoCategoria;
            }
        }
        return $arrayServicoCategorias;
    }

    public function buscarPeloIdDoServico($servicoId) {

        if ($this->servicoDaoMysql->buscarPeloId($servicoId)) {
            
            $arrayServicoCategorias = [];
    
            $sql = $this->pdo->prepare("SELECT * FROM servico_categorias WHERE servico_id = :servico_id");
            $sql->bindValue(':servico_id', $servicoId);
            $sql->execute();
            if($sql->rowCount() > 0){
                $arrayDadosServicoCategorias = $sql->fetchAll();
                foreach ($arrayDadosServicoCategorias as $dadoServicoCategoria) {
                    $servicoCategoria = new ServicoCategoria();
                    $servicoCategoria->setServicoId($dadoServicoCategoria['servico_id']);
                    $servicoCategoria->setCategoriaId($dadoServicoCategoria['categoria_id']);
                    $arrayServicoCategorias[] = $servicoCategoria;
                }
                return $arrayServicoCategorias;
            }
            return false;
        }
        return false;
    }

    public function buscarPeloIdDaCategoria($categoriaId) {

        if ($this->categoriaDaoMysql->buscarPeloId($categoriaId)) {

            $arrayServicoCategorias = [];

            $sql = $this->pdo->prepare("SELECT * FROM servico_categorias WHERE categoria_id = :categoria_id");
            $sql->bindValue(':categoria_id', $categoriaId);
            $sql->execute();
            if($sql->rowCount() > 0){
                $arrayDadosServicoCategorias = $sql->fetchAll();
                foreach ($arrayDadosServicoCategorias as $dadoServicoCategoria) {
                    $servicoCategoria = new ServicoCategoria();
                    $servicoCategoria->setServicoId($dadoServicoCategoria['servico_id']);
                    $servicoCategoria->setCategoriaId($dadoServicoCategoria['categoria_id']);
                    $arrayServicoCategorias[] = $servicoCategoria;
                }
                return $arrayServicoCategorias;
            }
            return false;
        }
        return false;
    }

    public function buscarPeloNomeDaCategoria($nome) {
        $arrayServicoCategorias = [];

        $sql = $this->pdo->prepare("SELECT * FROM categorias INNER JOIN servico_categorias ON servico_categorias.categoria_id = categorias.id WHERE nome = :nome");
        $sql->bindValue(':nome', $nome);
        $sql->execute();
        if($sql->rowCount() > 0){
            $arrayDadosServicoCategorias = $sql->fetchAll();
            foreach ($arrayDadosServicoCategorias as $dadoServicoCategoria) {
                $servicoCategoria = new ServicoCategoria();
                $servicoCategoria->setServicoId($dadoServicoCategoria['servico_id']);
                $servicoCategoria->setCategoriaId($dadoServicoCategoria['categoria_id']);
                $arrayServicoCategorias[] = $servicoCategoria;
            }
        }
        return $arrayServicoCategorias;
    }

    public function buscarCategoriasDoServico($servicoId)
    {
        $servicoCategoria = $this->buscarPeloIdDoServico($servicoId);

        $categorias = [];

        if ($servicoCategoria) {
            foreach ($servicoCategoria as $c) {
                $categorias[] = $this->categoriaDaoMysql->buscarPeloId($c->getCategoriaId());
            }
            return $categorias;
        }
        return false;
    }

    public function atualizar(ServicoCategoria $servicoCategoria) {
        $sql = $this->pdo->prepare("UPDATE servico_categorias SET servico_id = :servico_id, categoria_id = :categoria_id");
        $sql->bindValue(':servico_id', $servicoCategoria->getServicoId());
        $sql->bindValue(':categoria_id', $servicoCategoria->getCategoriaId());
        if($sql->execute()) {
            return true;
        }
        return false;
         
    }

    //Deleta uma categoria que foi associada a um determinado serviço
    public function deletarCategoriaDeUmServico($servicoId, $categoriaId) {
                
        if ($this->buscarPeloIdDoServico($servicoId) && $this->buscarPeloIdDaCategoria($categoriaId)) {

            $sql = $this->pdo->prepare("DELETE FROM servico_categorias WHERE (servico_id = :servico_id) AND (categoria_id = :categoria_id)");
            $sql->bindValue(':servico_id', $servicoId);
            $sql->bindValue(':categoria_id', $categoriaId);
            if($sql->execute()) {
                return true;
            }
            return false;
        }
        return false;
    }

    //Deleta uma categoria que foi associada a um determinado serviço pelo id do serviço
    public function deletarCategoriaServico($servicoId) {
                
        if ($this->buscarPeloIdDoServico($servicoId)) {

            $sql = $this->pdo->prepare("DELETE FROM servico_categorias WHERE (servico_id = :servico_id)");
            $sql->bindValue(':servico_id', $servicoId);
            if($sql->execute()) {
                return true;
            }
            return false;
        }
        return false;
    }

    //Deleta todas as associações entre categoria e serviço do banco
    public function deletar($servicoId) {
        $sql = $this->pdo->prepare("DELETE FROM servico_categorias WHERE servico_id = :servico_id");
        $sql->bindValue(':servico_id', $servicoId);
        if($sql->execute()) {
            return true;
        }
        return false;
    }

}