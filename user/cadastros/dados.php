<?php
	//verificar se o arquivo existe
	if ( file_exists ( "verificalogin.php" ) )
		include "verificalogin.php";
	else
		include "../verificalogin.php";

	//inicializar as variaveis
    $id = $nome = $email = $data_nascimento = $sexo = $idade = $Usuario_id = "";

    $Usuario_id = $_SESSION["imc"]["id"];
    
	//verificar o id - $p[2]
	if ( isset ( $p[2] ) && ($p[2] == $Usuario_id ) ) {
		//se enviado um id
		$id = $p[2];

		//select para selecionar o registro
		$sql = "select *, 
			date_format(data_nascimento, '%d/%m/%Y') data_nascimento 
			from pessoa 
			where Usuario_id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $Usuario_id);
		$consulta->execute();

		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$nome		= $dados->nome;
		$email		= $dados->email;
		$data_nascimento 		= $dados->data_nascimento;
		$sexo 		= $dados->sexo;
		$idade 	= $dados->idade;
		$Usuario_id 		= $dados->Usuario_id;

	} else {
        $msg = "Erro ao consultar Dados!";
        mensagem( $msg );
        exit;
    }

?>
<!-- Formulário de alteração de dados -->
<div class="container mt-3 p-5 shadow-none p-3 mb-5 bg-light rounded">
	<h2 class="text-center">Meus Dados Cadastrados</h2>
	<form name="dados" method="POST" action="salvar/dados" data-parsley-validate>

        <input type="hidden" class="form-control" name="id" value="<?=$id;?>" readonly>        
        <input type="hidden" class="form-control" name="Usuario_id" value="<?=$Usuario_id;?>" readonly>
                
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="<?=$nome;?>" required data-parsley-required-message="Preencha o nome">    
                </div> 

                <div class="form-group col-md-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?=$email;?>" required data-parsley-required-message="Preencha o email">   
                    
                </div>

                <div class="form-group col-md-2">
                    <label for="nascimento">Nascimento:</label>
                    <input type="text" class="form-control" name="data_nascimento" data-mask="99/99/9999" value="<?=$data_nascimento;?>">
                </div>

                <div class="form-group col-md-2">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control" required data-parsley-required-message="Selecione uma opção!">
                        <option value="">Selecione</option>
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>  
                    </select>    
                </div>
                
                <div class="form-group col-md-2">
                    <label for="idade">Idade atual:</label>
                    <input type="text" class="form-control" name="idade" value="<?=$idade;?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" name="data_fechamento" value="<?=$data_fechamento;?>" data-mask="99/99/9999" readonly>    
            </div> 
        <hr>
            <div class="text-right p-2">
                <button type="submit" class="btn btn-success">Alterar</button>
            </div>
    </form>
</div>

<!-- Função passar valor da var para preencher o select do form -->
<script type="text/javascript">
	$(document).ready(function(){
		//selecionar o id
		$("#sexo").val(<?=$sexo;?>);
	})
</script>
