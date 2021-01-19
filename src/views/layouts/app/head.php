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
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $routes->home?>src/views/public/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $routes->home?>src/views/public/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $routes->home?>src/views/public/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $routes->home?>src/views/public/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $routes->home?>src/views/public/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $routes->home?>src/views/public/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $routes->home?>src/views/public/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#28a745">
    <meta property="og:title" content="Jobfinder - jobs freelancer">
    <meta property="og:description" content="Encontre o job ideal pra você.">
    <meta property="og:image" content="<?php echo $routes->home."src/views/public/img/logomarca.png";?>">
    <meta property="og:url" content="<?php echo $routes->home ?>">
</head>

<body>
    <div id="app">
        <navbar-component logomarca="<?php echo $routes->home."src/views/public/img/logomarca.png";?>"
            homeurl="<?php echo $routes->home;?>" mensagens="<?php echo $routes->mensagens;?>"
            login="<?php echo $routes->login;?>" auth="<?php echo json_encode(auth())?>"
            perfilurl="<?php echo $routes->perfil;?>">
        </navbar-component> <!-- Componente Vue Navbar -->