<?php

namespace MyApp\Config;
use PDO;

class Conexao{
    
    private static $instace;

    private function __construct(){}
    
    public static function getInstance()
    {
        $driver = getenv('db_driver') ? getenv('db_driver') : 'mysql';
        $db_name = getenv('db_name') ? getenv('db_name') : 'jobfinder';
        $db_host = getenv('db_host') ? getenv('db_host') : 'localhost';
        $db_user = getenv('db_user') ? getenv('db_user') : 'root';
        $db_password =  getenv('db_password') ? getenv('db_password') : '';

        if(!isset(self::$instance)){
            return self::$instace = new PDO($driver.":dbname=".$db_name.";host=".$db_host, $db_user, $db_password);
        }
        return self::$instance;
    }
}