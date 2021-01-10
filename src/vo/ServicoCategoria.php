<?php
namespace App\VO;
use JsonSerializable;

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
