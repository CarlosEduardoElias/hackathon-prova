<?php
	//EFETUAR LOGIN

	//iniciar váriavel
	$msg = "";
	
	//verificar se foi dado o $_POST
	if ( $_POST ) {
		$login = $senha = "";
		if ( isset ( $_POST["login"] ) )
			$login = trim ( $_POST["login"] );

		if ( isset ( $_POST["senha"] ) )
			$senha = trim ( $_POST["senha"]);
		
		//verificar se os campos estão em branco
		if ( empty( $login ) ) {
			mensagem("Preencha o Login!");
		} else if (empty( $senha)) {
			mensagem("Preencha a Senha!");
		} else {
			//se os campos estiverem preenchidos, buscar usuario no banco
			$sql = "select id, login, senha from usuario where login = ? limit 1";
			//preparar o sql para execução
			$consulta = $pdo->prepare($sql);
			//passar o parâmetro
			$consulta->bindParam(1, $login);
			//executar
			$consulta->execute();
			//recuperar os dados da consulta
			$dados = $consulta->fetch(PDO::FETCH_OBJ); 

			//se existir o id
			if ( isset( $dados->id ) ){
				//verificar se trouxe algum resultado
				if ( !password_verify($senha, $dados->senha) ) {
					//verificar, se senha não é verdadeira
					$msg = "Senha Inválida!";
					mensagem($msg);
				
				} else {
					//guardar dados na sessão
					$_SESSION["imc"] = array(
						"id"=>$dados->id,
						"login"=>$dados->login,
					);

					//verificar array
					//print_r( $_SESSION["imc"] );

					//redirecionar a tela para home com js
					echo "<script>location.href='paginas/home'</script>";
					exit;
				}
			} else {
				//se não existir o id
				$msg = "Usuário Inexistente ou Desativado";
				mensagem($msg);
			}
		}
	}
?>
<!-- FORMULÁRIO DE LOGIN -->
<div class="container card mt-3" style="width: 18rem;">
	<img src="images/01.jpg" class="card-img-top mt-2" title="Login WeightLess" alt="Login">
	<div class="card-body">
		<form name="login" method="POST" action=""> 
			<div class="form-group">
				<label for="login">Usuário:</label>
				<input type="text" class="form-control" name="login" id="login" placeholder="Usuário">
				<small id="" class="form-text text-muted">Informe seu nome de Usuário</small>
			</div>
			<div class="form-group">
				<label for="senha">Senha:</label>
				<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
				<small id="" class="form-text text-muted">Digite sua Senha</small>
			</div>
			<div class="form-group text-center">
				<label class="form-check-label" for="exampleCheck1">Não possui cadastro?</label>
				<a href="../novo" class="link">Cadastrar</a>
			</div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-success">Login</button>
			</div>
		</form>
	</div>
</div>