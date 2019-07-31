<!-- FORMULÁRIO - ALTERAR SENHA -->
<div class="mt-3 p-5 shadow-none p-3 mb-5 bg-light rounded">
    <h2 class="text-center">Alterar Senha</h2>
    <form name="altera" id="altera" method="POST" action="cadastros/alterasenha" data-parsley-validate>           
        <div class="mt-3">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="atual">Senha atual:</label>
                    <input type="password" name="atual" class="form-control" placeholder="Digite a senha atual" required data-parsley-required-message="Informe a senha atual">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="senha">Nova Senha:</label>
                    <input type="password" name="nova" id="senha" placeholder="Informe a nova senha" class="form-control" required data-parsley-required-message="Preencha este campo">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="redigite">Redigite a Senha:</label>
                    <input type="password" name="redigite" id="redigite" class="form-control" placeholder="Redigite a nova senha" required data-parsley-required-message="Preencha este campo">
                </div>
            </div>
            <hr>
            <div class="text-right p-2">
                <button type="submit" class="btn btn-success" onclick="return validarSenha()">Alterar</button>
            </div>
        </div>      
    </form>
</div>

<!-- Função valida senha - by:Renan Garcia -->
<script type="text/javascript">
    function validarSenha(){
        var senha = altera.senha.value;
        var redigite = altera.redigite.value;
            if(redigite== "" || redigite.length <= 3){
                alert ('Preencha o campo da senha com no minimo 4 caracteres');
                altera.senha.focus();
                return false;
            }
            if(senha == "" || senha.length <= 3){
                alert ('Preencha o campo da senha com no minimo 4 caracteres');
                altera.senha.focus();
                return false;
            }
            if(senha != redigite){
                alert (' Senhas digitadas não conferem, são diferentes!'); 
                altera.redigite.focus();
            
                return false;
            }
    } 
</script>