<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

$database = new DB();


if(@$_POST['acao'] =="salvarconfig"){

	//$salario = $_POST['salario'];
	$salario_a = str_replace('.','', $_POST['salario']);
	$salario_novo = str_replace(',','.', $salario_a);

	$datatualizada = date("Y-m-d");

	$user_data = array(
		'date_update' => $datatualizada,
		'salariominimo' => $salario_novo
	 );
	$where_clause = array('id' => '1');
	$updated = $database->update( 'configuracao', $user_data, $where_clause, '' );


	echo ' <div class="alert alert-light-success color-success"><i  class="bi bi-check-circle"></i> Informações atualizadas.</div>';
}

	$query_configuracao = "SELECT *, DATE_FORMAT(date_update, '%d/%m/%Y') as ultimaatualizacao FROM configuracao WHERE  configuracao.id = '1' LIMIT 1";
	$results_configuracao  = $database->get_row( $query_configuracao );
?>

<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Itens de configuração do sistema</h4>
                    <br>Informação atualizada: <?php echo $results_configuracao->ultimaatualizacao;?>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="post">
                        	<input type="hidden" name="acao" value="salvarconfig">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="configuracao_salario">Salário minímo atual:</label>
                                        
                                    </div>
                                    <div class="col-md-8 form-group">
                                        

                                        <div class="input-group mb-3">
                                                    <span class="input-group-text" id="configuracao_salario">R$ </span>
                                                    <input type="text" class="form-control money2" name="salario" placeholder="Salário minimo atual" value="<?php echo $results_configuracao->salariominimo;?>" aria-describedby="configuracao_salario">
                                                </div>

                                    </div>
                                    
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>