<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/jobs');
} else{
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/jobfinder/login');
}
//Dar require em todas páginas que precisarem estar logadas para serem visualizadas.
//Require para copiar e colar nas páginas que necessitarem deste controle de login: require $_SERVER['DOCUMENT_ROOT'].'/jobfinder/controller/controle_sessao.php';