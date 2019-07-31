<?php
	//Definir a pagina como home
	$pagina = "home";
	//recuperar o parametro
	if ( isset ( $_GET["parametro"] ) )
	{
		$pagina = trim ( $_GET["parametro"]);
		//quebra uma string a partir de um caracter
		$p = explode("/", $pagina); 
		//print_r($p);
		// $p[0] - nome da pagina
		// $p[1] - id do registro
		$pagina = $p[0];
	}
	//verificar qual pagina ira carregar
	if ( $pagina == "sobre" )
		$titulo = "Sobre";
	else if ( $pagina == "contato" )
		$titulo = "Contato";
	else if ( $pagina == "novo" )
		$titulo = "Cadastro";
	else
		$titulo = "Inicio";
?>
<!-- PÁGINA INICIAL -->
<!DOCTYPE html>
<html>
<head>
	<title>WeightLess - <?=$titulo;?></title>
	<meta charset="utf-8">

	<base href="http://<?=$_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
	<link rel="stylesheet" type="text/css" href="css/summernote.min.css">
	<link rel="stylesheet" type="text/css" href="css/summernote-bs4.css">

	<link rel="shortcut icon" href="fotos/icone.png">

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="Js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="js/jquery.flot.min.js"></script>
	<script type="text/javascript" src="js/lightbox.min.js"></script>
	<script type="text/javascript" src="js/parsley.min.js"></script>
	<script type="text/javascript" src="js/summernote.min.js"></script>
	<script type="text/javascript" src="js/summernote-bs4.min.js"></script>
	<script type="text/javascript" src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.maskMoney.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/datepicker-pt-BR.js"></script>
	<script type="text/javascript" src="lang/summernote-pt-BR.min.js"></script>

</head>

<body>
<!-- CABEÇALHO -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="fotos/icone.png" width="30" height="30"  alt="WeightLess" title="WeightLess"> WeightLess</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse mr-2" id="menu">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item mr-2">
						<a class="nav-link" href="home">Home</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="sobre">Sobre</a>
					</li>
					<li class="nav-item mr-5">
						<a class="nav-link" href="contato">Contato</a>
					</li>
				</ul>
				<a class="btn btn-secondary my-2" href="user">Login</a>
			</div>
		</div>
	</nav>

<!-- CONTEÚDO PRINCIPAL -->
<main>
	<div class="container" style="padding-top: 70px;">
		<?php
			//configurar a pagina que ira ser incluida
			$pagina = "pages/".$pagina.".php";
			//verificar se a págian existe
			if ( file_exists($pagina) ) {
				include $pagina;
				//print_r($pagina);
			} else{
				include "erro.php";
			}
		?>
	</div>
</main>

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
</body>
</html>