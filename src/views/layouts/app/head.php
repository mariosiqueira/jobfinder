<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBFINDER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href='<?php echo $routes->home."src/views/public/app.css";?>'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div id="app">
        <navbar-component logomarca="<?php echo $routes->home."src/views/public/img/logomarca.png";?>"
            homeurl="<?php echo $routes->home;?>" mensagens="<?php echo $routes->mensagens;?>"
            login="<?php echo $routes->login;?>" auth="<?php echo json_encode(auth())?>"
            perfilurl="<?php echo $routes->perfil;?>">
        </navbar-component> <!-- Componente Vue Navbar -->