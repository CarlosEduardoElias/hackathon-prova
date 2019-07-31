<?php 
//verificar se existe uma página
	if ( !isset ( $pagina ) ) {
		header("location: index.php");
	}
?>
<!-- PÁGINA DE ERRO -->
<div class="p-5 text-center">
    <img src="images/error-404.png" class="img-fluid" title="Erro" alt="Erro">	
    <h3>A página que você procura, não pôde ser encontrada.</h3>
        <h4>Possíveis Motivos:</h4>
            <h5>O Conteúdo não está mais no ar;</h5>
            <h5>A página mudou de lugar;</h5>
            <h5>Você digitou o endereço errado.</h5>
            <a class="btn btn-info" href="index.php"> Voltar</a>
</div>