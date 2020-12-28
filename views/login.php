<?php
    if (auth()) {
        header("location: $routes->perfil");
    }
?>
<?php require "layouts/app/head.php"?>
    <login-component url_cadastro="<?php echo $routes->cadastro;?>" url_login='<?php echo $routes->login;?>' action_login='<?= $routes->action_login?>'></login-component>
<?php require "layouts/app/footer.php"?>