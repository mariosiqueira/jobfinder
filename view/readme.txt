Diretório para colocar todas as páginas do projeto.

Se for preciso utilizar o DAO para alguma entidade, é só dar os imports do config e do DAO da entidade no início do arquivo PHP.

ex:
<?php
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/config/config.php'; //Importa o PDO
require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/dao/UsuarioDaoMysql.php'; //Importa UsuarioDaoMysql para o CRUD

$usuarioDaoMysql = new UsuarioDaoMysql($pdo);

O usuarioDaoMysql vai conhecer todas as funções implementadas no arquivo UsuarioDaoMysql.php