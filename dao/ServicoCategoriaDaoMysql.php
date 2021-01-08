<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/vo/ServicoCategoria.php';

class ServicoCategoriaDaoMysql implements ServicoCategoriaDao {

    private $pdo;

    /**
     * O PDO vai ser passado por parâmetro no arquivo que 
     * precisar instanciar essa classe ServicoCategoriaDaoMysql.
     */

    public function __construct(PDO $driver){
        $this->pdo = $driver;
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
        $sql->execute();

        return $servicoCategoria;
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
        }
        return $arrayServicoCategorias;
    }

    public function buscarPeloIdDaSCategoria($categoriaId) {
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
        }
        return $arrayServicoCategorias;
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

    public function atualizar(ServicoCategoria $servicoCategoria) {
        $sql = $this->pdo->prepare("UPDATE servico_categorias SET servico_id = :servico_id, categoria_id = :categoria_id");
        $sql->bindValue(':servico_id', $servicoCategoria->getServicoId());
        $sql->bindValue(':categoria_id', $servicoCategoria->getCategoriaId());
        $sql->execute();
        
        return true;
    }

    //Deleta uma categoria que foi associada a um determinado serviço
    public function deletarCategoriaDeUmServico($servicoId, $categoriaId) {
        $sql = $this->pdo->prepare("DELETE FROM servico_categorias WHERE (servico_id = :servico_id) AND (categoria_id = :categoria_id)");
        $sql->bindValue(':servico_id', $servicoId);
        $sql->bindValue(':categoria_id', $categoriaId);
        $sql->execute();
    }

    //Deleta todas as associações entre categoria e serviço do banco
    public function deletar($servicoId) {
        $sql = $this->pdo->prepare("DELETE FROM servico_categorias WHERE servico_id = :servico_id");
        $sql->bindValue(':servico_id', $servicoId);
        $sql->execute();
    }

}