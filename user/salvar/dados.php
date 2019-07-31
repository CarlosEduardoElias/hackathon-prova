<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php";
    else
        include "../verificalogin.php";
        
    $pdo->beginTransaction();

    //se os dados vieram por POST
    if ( $_POST ) {
        //iniciar as variaveis
        $id = $nome = $email = $data_nascimento = $sexo = $idade = $Usuario_id = "";

        //recuperar as variaveis
        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            } 
        }
       
        // Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', $data_nascimento);
    
        // Descobre que dia é hoje e retorna a unix timestamp
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    
        // Depois apenas fazemos o cálculo já citado 
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        //função formatar data
        $data = formataData( $data_nascimento );
        
        //var_dump($id, $nome, $email, $data, $sexo, $idade, $Usuario_id );
           
        //se Usuario_id não estiver vazio  
        if ( !empty ( $Usuario_id ) ) {
    
            //sql a ser executado update
			$sql = "update pessoa set nome = :nome,
            email = :email, data_nascimento = :data, 
            sexo = :sexo, idade = :idade 
            where Usuario_id = :Usuario_id limit 1";

            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":nome",$nome);
            $consulta->bindValue(":email",$email);
            $consulta->bindValue(":data",$data);
            $consulta->bindValue(":sexo",$sexo);
            $consulta->bindValue(":idade",$idade);
            $consulta->bindValue(":Usuario_id",$Usuario_id);

        } else { 
            //echo $consulta->errorInfo();
            $msg = "Erro ao alterar Dados!";
            mensagem( $msg );
            exit;
        }

            //se executar sql
            if ( $consulta->execute() ) {
                
                //salvar no banco
                $pdo->commit();
    
                $msg = "Dados alterados com Sucesso!";
                sucesso( $msg, "index.php");
        
            } else {

                //erro do sql
                $pdo->rollback();

                //echo $consulta->errorInfo()[2];
                
                $msg = "Erro ao salvar";
                mensagem( $msg );
                exit;
            }
    
    } else {
        //se não foi veio do formulario
        $msg = "Requisição inválida";
        mensagem( $msg );
    }          