<?php

$db_driver = getenv('db_driver') ? getenv('db_driver') : 'mysql'; //pega o tipo de banco de dados nas variáveis se não achar o padrão é mysql
$db_name = getenv('db_name') ? getenv('db_name') : 'jobfinder'; //pega o nome do banco nas variáveis se não achar o padrão é jobfinder
$db_host = getenv('db_host') ? getenv('db_host') : 'localhost'; //pega o host do banco nas variáveis se não achar o padrão é localhost
$db_user = getenv('db_user') ? getenv('db_user') : 'root'; //pega o usuario do banco nas variáveis se não achar o padrão é root
$db_password = getenv('db_password') ? getenv('db_password') : ''; //pega a senha do banco nas variáveis se não achar o padrão é vazio

$pdo = new PDO("$db_driver:dbname=".$db_name.";host=".$db_host, $db_user, $db_password);