<?php
class UsuarioServico implements JsonSerializable{
    private $id;
    private $data_finalizacao_servico;
    private $valor_final;
    private $metodo_pagamento;
    private $servico_id;
    private $contratante_id;
    private $contratado_id;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'data_finalizacao_servico' => $this->data_finalizacao_servico,
            'metodo_pagamento' => $this->metodo_pagamento,
            'valor_final' => $this->valor_final,
            'servico_id' => $this->servico_id,
            'contratante_id' => $this->contratante_id,
            'contratado_id' => $this->contratado_id,
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = trim($id);
    }

    public function getDataFinalizacaoServico(){
        return $this->data_finalizacao_servico;
    }

    public function setDataFinalizacaoServico($data_finalizacao_servico){
        $this->data_finalizacao_servico = trim($data_finalizacao_servico);
    }

    public function getMetodoPagamento(){
        return $this->metodo_pagamento;
    }

    public function setMetodoPagamento($metodo_pagamento){
        $this->metodo_pagamento = trim($metodo_pagamento);
    }

    public function getValorFinal(){
        return $this->valor_final;
    }

    public function setValorFinal($valor_final){
        $this->valor_final = $valor_final;
    }

    public function getServicoId(){
        return $this->servico_id;
    }

    public function setServicoId($servico_id){
        $this->servico_id = $servico_id;
    }

    public function getContratanteId(){
        return $this->contratante_id;
    }

    public function setContratanteId($contratante_id){
        $this->contratante_id = $contratante_id;
    }

    public function getContratadoId(){
        return $this->contratado_id;
    }

    public function setContratadoId($contratado_id){
        $this->contratado_id = $contratado_id;
    }
}

interface UsuarioServicoDao {
    public function salvar(UsuarioServico $usuarioServico);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarPeloContratante_id($contratante_id);
    public function atualizar(UsuarioServico $usuarioServico);
    public function deletar($id);
}
