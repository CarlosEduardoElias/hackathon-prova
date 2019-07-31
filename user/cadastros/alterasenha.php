<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

    
    $pdo->beginTransaction();
        
    //se os dados vieram por POST
    if ( $_POST ) {
        //iniciar as variaveis
        $atual = $nova = "";

        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            } 
        }

        $id = $_SESSION["imc"]["id"];

        //sql a ser executado select
        $sql = "select senha from usuario where id = ? limit 1";

        //preparar o sql para execução
        $consulta = $pdo->prepare($sql);

        //passar o parâmetro
        $consulta->bindParam(1, $id);

        //executar
        $consulta->execute();

        //recuperar os dados da consulta
        $dados = $consulta->fetch(PDO::FETCH_OBJ); 

        $senha = $dados->senha;
        
        //var_dump ( $senha, $atual, $nova);
        
        //verificar e comparar senhas
        if ( password_verify ( $atual, $senha ) ) {

            //nova senha recebe criptografia
            $nova = password_hash($nova, PASSWORD_DEFAULT); 

            //sql a ser executado update
            $sql = "update usuario set senha = :nova where id = :id limit 1";

            //preparar o sql para execução
            $consulta = $pdo->prepare($sql);

            //passar parâmetros
            $consulta->bindValue(":nova",$nova);
            $consulta->bindValue(":id",$id);

            //se executar sql
            if ( $consulta->execute() ) {
 
                //salvar no banco
                $pdo->commit();

                //exibir mensagem e deslogar usuário
                $msg = "Senha Alterada, Realize o Login!";
                sucesso( $msg, "sair.php" );
                
            } else {
                //erro do sql
                //echo $consulta->errorInfo()[2];
                $msg = "Erro! Não foi possível Alterar!";
                mensagem( $msg );
                exit;
            }
            
        } else {
            $msg = "Senha atual digitada é Inválida!";
            mensagem($msg);
            exit;
        }

    } else {
        $msg = "Requisição Inválida!";
        mensagem($msg);
    }
