<?php
class Servico implements JsonSerializable {
    private $id;
    private $titulo;
    private $descricao;
    private $enderecoServico;
    private $valor;
    private $usuarioId;
    private $dataPostagem;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'enderecoServico' => $this->enderecoServico,
            'valor' => $this->valor,
            'usuarioId' => $this->usuarioId,
            'dataPostagem' => $this->dataPostagem
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
        $this->valor = trim($valor);
    }

    public function getUsuarioId(){
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId){
        $this->usuarioId = trim($usuarioId);
    }

    public function getDataPostagem(){
        return $this->dataPostagem;
    }

    public function setDataPostagem($dataPostagem){
        $this->dataPostagem = trim($dataPostagem);
    }
}

interface ServicoDao {
    public function salvar(Servico $servico);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarServicoPeloIdDoUsuario($usuarioId);
    public function atualizar(Servico $servico);
    public function deletar($id);
}