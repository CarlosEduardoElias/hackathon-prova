<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

        //INICIAR
        $nome = $idade = $sexo = "";

        $Usuario_id = $_SESSION["imc"]["id"];
        
        //EXECUTAR SQL SELECT   
        $sql = "select id from pessoa where Usuario_id = :Usuario_id";

        $consulta = $pdo->prepare( $sql );
        $consulta->bindValue(":Usuario_id",$Usuario_id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id;

        //print_r($id);
    
        //se id não estiver vazio
        if ( !empty ($id) ){
            
            //sql a ser executado select
            $sql = "SELECT nome, idade, sexo, date_format(data_nascimento,'%d/%m/%Y') data_nascimento from pessoa where id = :id";
            $consulta = $pdo->prepare($sql);
            $consulta->bindValue(":id",$id);
            $consulta->execute();

            //laço de repetição para separar as linhas
            while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {

                //separar os dados
                $nome 	= $linha->nome;
                $idade 	= $linha->idade;
                $sexo	= $linha->sexo;
                $data_nascimento = $linha->data_nascimento;
            }
        }    
?>
<!-- PÁGINA DE LISTAGEM DE CÁLCULOS IMC -->
<div class="mt-2 table-responsive shadow-none p-3 mb-5 bg-light rounded">
    <h1 class="text-center">Histórico de Índice de Massa Corpórea(IMC)</h1>
    <div class="text-center">
        <a href="cadastros/calculo" class="btn btn-info mt-4 ml-3 p-2">Novo Cálculo</a>
    </div> 
        <form>
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <label for="data">Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?=$nome;?>" readonly> 
                </div>     
                <div class="form-group col-md-1">  
                <label for="data">Idade:</label>
                <input type="text" class="form-control" name="idade" value="<?=$idade;?>" readonly>
                </div>     
                <div class="form-group col-md-3">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control" readonly>
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>  
                    </select>    
                </div>  
                <div class="form-group col-md-2">
                <label for="data">Nascimento:</label>
                <input type="text" class="form-control" name="sexo" value="<?=$data_nascimento;?>" readonly>
                </div> 
            </div> 
        </form>
		<table class="table table-hover table-striped table-sm shadow-lg p-3 mb-5 bg-white rounded">
            <thead>
                <tr>
                <th class="table-success" scope="col">Inclusão</th>  
                <th class="table-secondary" scope="col">Altura</th>
                <th class="table-secondary" scope="col">Peso</th>
                <th class="table-primary" scope="col">IMC</th>
                <th class="table-success" scope="col">Classificação</th>
                <th class="table-danger" scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>

            <?php

                if ( !empty ($id)){
                    // print_r($id);
                    
                    //sql a ser executado select
                    $sql = "SELECT id, date_format(data_inclusao,'%d/%m/%Y') data_inclusao, altura, peso, imc, resultado from resultado where Pessoa_id = :id ORDER BY imc";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindValue(":id",$id);
                    $consulta->execute();

                    //laço de repetição para separar as linhas
                    while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {

                        //separar os dados
                        $id = $linha->id;
                        $data_inclusao = $linha->data_inclusao;
                        $altura 	= $linha->altura;
                        $peso 	= $linha->peso;
                        $imc 	= $linha->imc;
                        $resultado 	= $linha->resultado;

                        //montar as linhas e colunas da tabela
                        echo " <tr> 
                                    <td> $data_inclusao</td>
                                    <td> $altura </td>
                                    <td> $peso </td>
                                    <td> $imc </td>	
                                    <td> $resultado </td>
                                    <td> <a href='javascript:excluir($id)' class='btn btn-danger'>
                                    Excluir
                                    </a> </td>
                                </tr> ";

                    }
                }
            ?>
            </tbody>
        </table>
</div> 

<script type="text/javascript">
   
        //funcao em javascript para perguntar se quer mesmo excluir
        function excluir(id) {
            //perguntar
            if ( confirm("Deseja mesmo excluir?" ) ) {
                //chamar a tela de exclusão
                location.href = "excluir/calculo/"+id;
            }
        }

        $(document).ready( function () {
            
        //selecionar o id preencher select
		$("#sexo").val(<?=$sexo;?>)

        //datatable config language
	    $('.table').DataTable( {
            "language": {
                "lengthMenu": "Mostrar  _MENU_  resultados por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro adiciondo!",
                "infoFiltered": "(filtrando de _MAX_ em um total de registros)",
                "search":"Buscar",
                paginate: {
                    previous: 'Anterior',
                    next:     'Próximo'
                }
        
            }
        });
	} );
</script>
