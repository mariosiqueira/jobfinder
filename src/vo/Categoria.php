<?php
namespace App\VO;
use JsonSerializable;

class Categoria implements JsonSerializable{
    private $id;
    private $nome;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
        ];
    }

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = trim($id);
    }
    
    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = ucwords(trim($nome));
    }
}