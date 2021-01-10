<?php
namespace App\VO;

interface CategoriaDao {
    public function salvar(Categoria $categoria);
    public function buscarTodas();
    public function buscarPeloId($id);
    public function buscarPeloNome($nome);
    public function atualizar(Categoria $categoria);
    public function deletar($id);
}