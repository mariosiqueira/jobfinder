<?php
namespace App\VO;

interface UsuarioServicoDao {
    public function salvar(UsuarioServico $usuarioServico);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarPeloContratanteId($contratanteId);
    public function buscarPeloContratadoId($contratadoId);
    public function atualizar(UsuarioServico $usuarioServico);
    public function deletar($id);
    public function deletarPeloServicoId($servicoId);
}
