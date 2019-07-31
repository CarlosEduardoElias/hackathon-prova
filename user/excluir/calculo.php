<?php
	//verificar se o arquivo existe
	if ( file_exists ( "verificalogin.php" ) )
		include "verificalogin.php";
	else
		include "../verificalogin.php";


	//verificar se esta sendo enviado o id na p2
	if ( isset ( $p[2] ) ) {

		//passar como inteiro
		$id = (int)$p[2];
		
		//echo "<pre>";
		//var_dump($id);
		//var_dump($p);
        
		//sql a ser executado delete
		$sql = "delete from resultado where id = ? limit 1";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam(1,$id);

		//verificar se o registro foi excluido
		if ( $consulta->execute() ) {
			$msg = "Registro excluído ";
			mensagem ( $msg );
		} else {
			$msg = "Erro ao excluir";
			mensagem( $msg );
		}
  
	} else {
		//ERRO
		$msg = "Ocorreu um erro ao excluir";
		mensagem( $msg );

    }
  