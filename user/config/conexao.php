<?php
	//conexão com banco PDO

	//Conexão Remota
	/*
	$servidor = "";
	$usuario = "";
	$senha = "";
	//selecionar banco IMC
	$banco = "";
	*/

	//Conexão Local
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	//selecionar banco IMC
	$banco = "imc";
	
	$charset = "utf8";

	try {
		//CONEXAO PDO
		$pdo = new PDO("mysql:host=$servidor;dbname=$banco;charset=$charset", $usuario, $senha);
	} catch (PDOException $erro) {
		$msg = $erro -> getMessage();
		echo "<p>Erro ao conectar no Banco: $msg</p>";
	}

?>
