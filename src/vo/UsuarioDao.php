<?php
namespace App\VO;

interface UsuarioDao {
    public function salvar(Usuario $usuario);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarPeloEmail($email);
    public function atualizar(Usuario $usuario);
    public function deletar($id);
}