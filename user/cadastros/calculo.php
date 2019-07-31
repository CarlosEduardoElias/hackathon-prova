<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

    //Iniciar as variaveis
    $id = $Usuario_id = $data = $altura = $peso = $imc = $classificacao = $data_fechamento = "";
    
    //data = atual
    $data = date('d/m/Y');
    
    $Usuario_id = $_SESSION["imc"]["id"];

    //Consulta para passar o id da pessoa pelo formulário
    if ( !empty ( $Usuario_id ) ) {
    
        //sql consulta
        $sql = "select id from pessoa where Usuario_id = :Usuario_id";

        $consulta = $pdo->prepare( $sql );
        $consulta->bindValue(":Usuario_id",$Usuario_id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id;

    } 
  
?>
<!-- Formulário de Calculo de IMC-->
<div class="mt-3 p-5 shadow-none p-3 mb-5 bg-light rounded">
    <h2 class="text-center">Calcular Índice de Massa Corpórea(IMC)</h2>
        <div class="text-center">
            <a href="listar/historico" class="btn btn-info mt-3">Ver meu Histórico</a>
        </div>

	<form name="calculo" id="calculo" method="POST" action="salvar/calculo" data-parsley-validate>
              
        <input type="hidden" class="form-control" name="id" value="<?=$id;?>" readonly>
                    
        <div class="form-row mt-4">
            <div class="form-group col-md-2">
                <label for="data">Data:</label>
                <input type="text" class="form-control" name="data" value="<?=$data;?>"  readonly>    
            </div> 
            <div class="form-group col-md-2">
                <label for="altura">Altura:</label>
                <input type="text" class="form-control" name="altura" id="altura" placeholder="0.00" data-mask="9.99" value="<?=$altura;?>" required data-parsley-required-message="Preencha a Altura!">   
                
            </div>
            <div class="form-group col-md-2">
                <label for="peso">Peso:</label>
                <input type="text" class="form-control" name="peso" id="peso" value="<?=$peso;?>" placeholder="00" required data-parsley-required-message="Preencha o Peso!">
            </div>
            <div class="form-group col-md-4">
                <label for="imc">Resultado IMC:</label>
                <input type="text" class="form-control" name="imc" id="imc" value="<?=$imc;?>" readonly required data-parsley-required-message="IMC Não Calculado!">      
            </div>
        </div>
            <div class="form-group">
                <label for="resultado">Sua classificação:</label>
                <input type="text" class="form-control" name="resultado" id="resultado" value="<?=$classificacao;?>" readonly readonly required data-parsley-required-message="Sem Resultado!">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="data_fechamento" value="<?=$data_fechamento;?>" data-mask="99/99/9999" readonly>    
            </div> 
        <div class="text-right p-2">
            <a  class="btn btn-warning" onclick="CalculoImc();">Calcular</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>

<!-- Função JS que calcula e classifica o IMC preenchendo o formulário -->   
<script type="text/javascript">
function CalculoImc(){
var altura = document.calculo.altura.value;
var peso = document.calculo.peso.value;
var resultado = "Indefinido";

var imc = peso /(altura*altura);
document.calculo.imc.value = imc.toFixed(2);

    if ( imc <= 0) {
        alert ("Imc Inválido!");
    } else if ( imc < 18.5) {
        var resultado = "Abaixo do Peso";
    } else if (imc < 25) {
        var resultado = "Peso Ideal";
    } else if (imc < 30) {
         var resultado = "Levemente Acima do Peso";
    } else if (imc < 35) {
        var resultado = "Obesidade Grau 1";
    } else if (imc < 40) {
        var resultado = "Obesidade Grau 2 (severa)";
    } else if (imc <= 60) {
        var resultado = "Obesidade Grau 3 (mórbida)";
    }  else {
        alert ("Erro ao efetuar calculo!");
        document.getElementById("calculo").reset();
    } 
    document.calculo.resultado.value = resultado;
}
</script>