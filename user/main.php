<?php 
	if ( !isset ( $pagina ) ) {
		header("location: index.php");
	}
	
?>
<!-- CABEÇALHO -->
<header>
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
	<div class="container">
	<a class="navbar-brand" href="index.php"><img src="images/icone.png" width="30" height="30"  alt="WeightLess" title="WeightLess"> WeightLess</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse mr-2" id="menu">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item mr-2">
					<a class="nav-link" href="cadastros/calculo">Calcular Meu IMC</a>
				</li>

				<li class="nav-item mr-2">
					<a class="nav-link" href="listar/historico">Histórico</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="paginas/duvidas">Dúvidas</a>
				</li>
				
				<li class="nav-item mr-3 menu dropdown">
					<a class="nav-link dropdown-toggle text-uppercase" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <strong> <?=$_SESSION["imc"]["login"];  ?>  </strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="cadastros/dados/<?=$_SESSION["imc"]["id"];?> ">Seus dados</a>
						<a class="dropdown-item" href="paginas/alterasenha">Mudar senha</a>
					</div>
				</li>

				<li class="mt-2">
					<a class="btn btn-outline-secondary" href="sair.php">Sair</a>
				</li>
			</ul>
		</div>
		</div>
	</nav>
</header>
<!-- CONTEÚDO PRINCIPAL -->
<main>
	<div class="container" style="padding-top: 70px;">
		<?php
			
			if ( file_exists ( $pagina ) ) include $pagina;
			else include "paginas/erro.php";
		?>
	</div>
	<!-- RODAPÉ -->
	<footer class="bg-dark text-center p-4">
		<div class="text-light">
			<blockquote class="blockquote">
				<p class="mb-0"> O resultado depende principalmente das mudanças nos hábitos de vida.</p>
				<footer class="blockquote-footer"><cite title="Source Title">Equipe WeightLess</cite></footer>
			</blockquote>
			<p>&copy; WeightLess | 2019 - Todos os direitos reservados. </p>
		</div>
	</footer>
</main>