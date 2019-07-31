<?php
	// FUNÇÕES PHP

	/* Função para mostrar uma mensagem e voltar
	$msg - mensagem
	*/
	function mensagem($msg) {
		// alert - função js para mostrar mensagem em pop up
		// history.back() - retorna para página anterior
		echo "<script>alert('$msg');history.back();</script>;
	  ";
		exit;
	}

	//Mensagem de sucesso
	function sucesso($msg, $link) {
		echo "<script>alert('$msg');location.href='$link';</script>;";
		exit;
	}

	//Formatar valores
	function formataValor ($valor){
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		return $valor;
	}

	/*
    $data = '25/11/1999';
   
    // Separa em dia, mês e ano
    list($dia, $mes, $ano) = explode('/', $data);
   
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
   
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
	*/

	//Transformar data
	function formataData( $data){
		//12/04/2019 -> 2019-02-10
		$data = explode("/",$data);
		//0 - dia/ 1 - mes/ 2 - ano
		if ( !checkdate($data[1], $data[0], $data[2])){
			$msg = "Data Inválida!";
			mensagem($msg);
		}
		$data = $data[2]."-".$data[1]."-".$data[0];
		return $data;
	}


