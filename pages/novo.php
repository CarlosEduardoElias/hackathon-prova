<!-- FORMULÁRIO DE CADASTRO DE USUÁRIO -->
<div class="container mt-3 p-5 shadow-none p-3 mb-5 bg-light rounded">
	<h2 class="text-left">Novo Cadastro</h2>
    
    <form name="cadastro" id="cadastro" method="POST" action="usuario" data-parsley-validate>           
        <div class="form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" required data-parsley-required-message="Preencha o nome">    
            </div> 

            <div class="form-group">
                <label for="altura">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required data-parsley-required-message="Preencha o email">      
            </div>

            <div class="row">
                <div class="col-md-2">
                <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control" required data-parsley-required-message="Selecione">
                        <option value="">Selecione</option>
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>  
                    </select>    
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group col-md-4">
                    <label for="nascimento">Data de Nascimento:</label>
                    <input type="text" class="form-control" name="data_nascimento" data-mask="99/99/9999" required data-parsley-required-message="Informe a data">
                </div> 
            </div>
                
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="login">Login:</label>
                    <input type="text" name="login" class="form-control" required data-parsley-required-message="Preencha este campo">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required data-parsley-required-message="Preencha este campo">
                </div>

                <div class="form-group col-md-6">
                    <label for="redigite">Redigite a Senha:</label>
                    <input type="password" name="redigite" id="redigite" class="form-control" required data-parsley-required-message="Preencha este campo">
                </div>
            </div>
        
            <div class="text-right p-2">
                <button type="submit" class="btn btn-success" onclick="return validarSenha()">Cadastrar</button>
            </div>
    </form>
</div>

<!-- Função valida senha - by:Renan Garcia -->
<script type="text/javascript">
    function validarSenha(){
        var senha = cadastro.senha.value;
        var redigite = cadastro.redigite.value;
            if(redigite== "" || redigite.length <= 3){
                alert ('Preencha o campo da senha com no minimo 4 caracteres');
                cadastro.senha.focus();
                return false;
            }
            if(senha == "" || senha.length <= 3){
                alert ('Preencha o campo da senha com no minimo 4 caracteres');
                cadastro.senha.focus();
                return false;
            }
            if(senha != redigite){
                alert (' Senhas digitadas não conferem, são diferentes!'); 
                cadastro.redigite.focus();
            
                return false;
            }
    } 
</script>