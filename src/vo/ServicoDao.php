<?php
namespace App\VO;

interface ServicoDao {
    public function salvar(Servico $servico);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarServicoPeloIdDoUsuario($usuarioId);
    public function atualizar(Servico $servico);
    public function deletar($id);
    public function buscarServicoPeloStatus($status);
}