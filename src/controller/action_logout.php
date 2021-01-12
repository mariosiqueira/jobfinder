<?php
session_start();
$_SESSION['auth'] = null;

header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder');
exit();