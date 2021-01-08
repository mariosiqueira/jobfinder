<?php

require $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';
var_dump($_SERVER['DOCUMENT_ROOT']);
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Chat;


    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8180
    );

    $server->run();