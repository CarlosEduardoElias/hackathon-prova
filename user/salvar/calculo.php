<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php";
    else
        include "../verificalogin.php";
  
    $pdo->beginTransaction();

        //se os dados vieram por POST
    if ( $_POST ) {
        //iniciar as variaveis
        $id = $data = $altura = $peso = $imc = $resultado = $data_fechamento = "";

        //recuperar as variaveis
        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            } 
        }
    
            //formatar a datas
            $data = formataData( $data );
            
            //var_dump($id, $data, $altura, $peso, $imc, $resultado, $data_fechamento);
           
            //se existir um id
            if ( isset ( $id ) ) {
    
                //sql a ser executado para insert
                $sql = "insert into resultado 
                (id, Pessoa_id, data_inclusao, altura, peso, imc, resultado, data_fechamento)
                values 
                (NULL, :Pessoa_id, :data, :altura, :peso, :imc, :resultado, :data_fechamento)";
    
                $consulta = $pdo->prepare( $sql );
                $consulta->bindValue(":Pessoa_id",$id);
                $consulta->bindValue(":data",$data);
                $consulta->bindValue(":altura",$altura);
                $consulta->bindValue(":peso",$peso);
                $consulta->bindValue(":imc",$imc);
                $consulta->bindValue(":resultado",$resultado);
                $consulta->bindValue(":data_fechamento",$data_fechamento);

            } else { 
                //echo $consulta->errorInfo();
                $msg = "Erro ao salvar IMC";
                mensagem( $msg );
                exit;
            }

                if ( $consulta->execute() ) {
                    
                    //salvar no banco
                    $pdo->commit();
        
                    $msg = "IMC inserido com sucesso!";
                    sucesso( $msg, "listar/historico");
            
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