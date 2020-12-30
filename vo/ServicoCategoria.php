<?php

class ServicoCategoria implements JsonSerializable {
    private $servicoId;
    private $categoriaId;

    public function jsonSerialize() {
        return [
            'servicoId' => $this->servicoId,
            'categoriaId' => $this->categoriaId
        ];
    }

    public function getServicoId(){
        return $this->servicoId;
    }

    public function setServicoId($servicoId){
        $this->servicoId = trim($servicoId);
    }

    public function getCategoriaId(){
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId){
        $this->categoriaId = trim($categoriaId);
    }

}

interface ServicoCategoriaDao {
    public function salvar(ServicoCategoria $servicoCategoria);
    public function buscarTodos();
    public function buscarPeloIdDoServico($servicoId);
    public function buscarPeloIdDaSCategoria($categoriaId);
    public function buscarPeloNomeDaCategoria($nome);
    public function atualizar(ServicoCategoria $servicoCategoria);
    public function deletarCategoriaDeUmServico($servicoId, $categoriaId);
    public function deletar($servicoId);
}