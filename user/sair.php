<?php 
session_start();
//encerrar sessão
unset($_SESSION["imc"]);
//redirecionar página
header("location: index.php");