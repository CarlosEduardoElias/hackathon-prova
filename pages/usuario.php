<?php
    //CADASTRO DE USUÁRIO

    //incluindo arquivo de conexao com o banco e funções
    include "user/config/conexao.php";
    include "user/config/funcoes.php";

    //iniciando transação
    $pdo->beginTransaction();

    //se os dados vieram por POST
    if ( $_POST ) {
        //iniciar as variaveis
        $id = $nome = $email = $data_nascimento = $sexo = $idade = $Usuario_id = $login = $senha = $usuario = $pessoa = "";

        //recuperar as variaveis
        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            } 
        }

        //validar data com a função formataData
        $data = formataData( $data_nascimento );

        //Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', $data_nascimento);
    
        //Descobre que dia é hoje e retorna a unix timestamp
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        //Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    
        //Depois apenas fazemos o cálculo já citado :)
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        //criptografar senha
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        
        //var_dump($id, $nome, $email, $data, $sexo, $idade, $Usuario_id, $login, $senha );
       
        //se existir variavel $login, consulta no BD login e email
        if ( isset ($login) ) {
            //sql que será executado
            $sql = "select u.login, p.email from usuario as u, pessoa as p where u.login = :login or p.email = :email limit 1 ";
            $consulta = $pdo->prepare($sql);
            $consulta->bindValue(":login",$login); 
            $consulta->bindValue(":email",$email); 
            $consulta->execute();
            $dados = $consulta->fetch(PDO::FETCH_OBJ);
            
            $usuario = $dados->login;
            $pessoa = $dados->email;
        
            //var_dump($usuario, $pessoa);
         
        } else {
            $msg = "Erro - Preencha Corretamente!";
            mensagem( $msg );
        }

        //se pessoa e usuario estiverem vazio, inserir dados e mostrar mensagem "cadastro realizado", se não, retorna mensagem "usuario já cadastrado"
        if ( empty ( $usuario & $pessoa) ) {
         
            // $sql1 = "insert into usuario (id, login, senha) values (NULL, '$login', '$senha')";

            //sql que será executado
            $sql = "SET AUTOCOMMIT=0;
            START TRANSACTION;
            INSERT INTO usuario(id, login, senha)
            VALUES(NULL, '$login', '$senha');
            INSERT INTO pessoa(id, nome, email, data_nascimento, sexo, idade, Usuario_id)
            values(NULL, '$nome', '$email', '$data', '$sexo', '$idade', (SELECT LAST_INSERT_ID()));
            COMMIT;
            SET AUTOCOMMIT=1;";

            $consulta = $pdo->prepare($sql);
        
            if ( $consulta->execute() ) {
                //salvar no banco
                $pdo->commit();
                
                $msg = "Cadastro relizado com Sucesso!";
                sucesso( $msg, "user/login");
        
            } else {
                //erro do sql
                $pdo->rollback();
                //exibir erro
                //echo $consulta->errorInfo()[2];
                $msg = "Erro ao Cadastrar";
                mensagem( $msg );
                exit;
            }

		} else {
            $msg = "Este email ou usuário já foi cadastrado!";
			mensagem($msg);
        }  
           
    } else {
        //se não vier pelo método POST
        $msg = "Requisição Inválida!";
        mensagem($msg);
    }