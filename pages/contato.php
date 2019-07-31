<?php
    //CADASTRO DE MENSAGENS

    //incluindo arquivo de conexao com o BD e funções
    include "user/config/conexao.php";
    include "user/config/funcoes.php";

    //iniciando as variaveis vazias
    $nome = $email = $msg = "";

    //se dados enviados por POST
    if ( $_POST ) {

      //recuperando os dados passados por POST
      if ( isset ( $_POST["nome"] ) ) {
        $nome = trim ( $_POST["nome"] );
      }

      if ( isset ( $_POST["email"] ) ) {
        $email = trim ( $_POST["email"] );
      }

      if ( isset ( $_POST["msg"] ) ) {
        $msg = trim ( $_POST["msg"] );
      }
        
      //var_dump($nome, $email, $msg);

      //variavel $data recebe data atual
      $data = date('d/m/Y');
      
      //função valida e formata data
      $data = formataData( $data );

        //se não estiver vazio os dados passados por POST
        if  ( !empty ( $_POST) ){
            //inserir no banco

            //sql que será executado
            $query = "insert into mensagem (id, nome,email,mensagem,data) 
              values (NULL, :nome , :email, :msg, :data)";
            
            //instanciar o sql na conexao (pdo) e prepara o sql para ser executado
            $consulta = $pdo->prepare( $query );
            
            $consulta->bindValue(":nome",$nome);
            $consulta->bindValue(":email",$email);
            $consulta->bindValue(":msg",$msg);
            $consulta->bindValue(":data",$data);
      
            //verificar se o comando será executado corretamente
            //salvar no banco
            if ( $consulta->execute() ) {
              echo "<script>alert('Sua mensagem foi enviada com sucesso!');location.href='home';</script>";
              exit;
            } else {
              //erro - exit 
              echo "<script>alert('Erro ao enviar mensagem!');history.back();</script>";
              exit;
            }

        } else {
          //erro
          echo "<script>alert('Erro - Preencha o Formulário!');history.back();</script>";
        }
    }  
?>

<!-- FORMULÁRIO DE MENSAGEM -->
<div class="mt-3 shadow-none p-3 mb-5 bg-light rounded">
  <h2 class="text-center">Entre em Contato</h2>
  <form name="mensagem" method="POST" action="" data-parsley-validate>
    <div class="row">
      <div class="col-md-5">
          <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" placeholder="Digite seu nome" maxlenght="50" required data-parsley-required-message="Preencha este campo">
          </div>  
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" maxlenght="50" placeholder="exemplo@email.com" required data-parsley-required-message="Preencha este campo">  
          </div>
      </div>
      <div class="col-md-7">
        <label for="msg">Mensagem:</label>
          <textarea data-ls-module="charCounter" maxlength="150" class="form-control" name="msg" id="msg" rows="4" required data-parsley-required-message="Preencha este campo"></textarea>
          <small id="" class="form-text text-muted">Máximo 150 caracteres</small>
      </div>
    </div>
      <div class="text-right">
        <button type="submit" class="btn btn-success">Enviar</button> 
      </div>
  </form>
</div>

