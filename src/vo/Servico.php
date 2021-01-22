<?php
namespace App\VO;
use JsonSerializable;

class Servico implements JsonSerializable {
    private $id;
    private $titulo;
    private $descricao;
    private $enderecoServico;
    private $valor;
    private $usuarioId;
    private $dataPostagem;
    private $status;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'enderecoServico' => $this->enderecoServico,
            'valor' => $this->valor,
            'usuarioId' => $this->usuarioId,
            'dataPostagem' => $this->dataPostagem,
            'status' => $this->status,
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = trim($id);
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = ucwords(trim($titulo));
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = trim($descricao);
    }

    public function getEnderecoServico(){
        return $this->enderecoServico;
    }

    public function setEnderecoServico($enderecoServico){
        $this->enderecoServico = trim($enderecoServico);
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getUsuarioId(){
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId){
        $this->usuarioId = $usuarioId;
    }

    public function getDataPostagem(){
        return $this->dataPostagem;
    }

    public function setDataPostagem($dataPostagem){
        $this->dataPostagem = trim($dataPostagem);
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status){
        $this->status = trim($status);
    }
}
