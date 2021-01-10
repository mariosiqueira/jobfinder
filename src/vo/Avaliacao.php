<?php
namespace App\VO;
use JsonSerializable;

class Avaliacao implements JsonSerializable{
    private $id;
    private $avaliacao;
    private $comentario;
    private $userId;
    private $avaliadorId;
    

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'avaliacao' => $this->avaliacao,
            'comentario' => $this->comentario,
            'userId' => $this->userId,
            'avaliadorId' => $this->avaliadorId,
        ];
    }

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = trim($id);
    }
    
    public function getAvaliacao(){
        return $this->avaliacao;
    }

    public function setAvaliacao($avaliacao){
        $this->avaliacao = trim($avaliacao);
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getAvaliadorId(){
        return $this->avaliadorId;
    }

    public function setAvaliadorId($avaliadorId){
        $this->avaliadorId = $avaliadorId;
    }

}
