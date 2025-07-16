<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Edição de dados de médico */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Edição de dados de médico */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

	$query_medicos = "SELECT * FROM medicos WHERE  medicos.id = '".$_GET['id']."' LIMIT 1";
	$results_medicos  = $database->get_row( $query_medicos );
?>
<!--html-->




<div class="element-wrapper">
	<div class="element-box">
  		<div class="loadingform"></div>
  		<div class="formarea">

			<form id="form_medico_editar" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="id_medico" value="<?php echo $_GET['id'];?>">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-4">
							<label for="nome_medico">Nome </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome" data-error="Campo necessário"  required="required" name="nome_medico" id="nome_medico" type="text" value="<?php echo $results_medicos->nome;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="telefone_medico">Telefone:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control telefone" placeholder="Telefone" data-error="Campo necessário"  required="required" name="telefone_medico" id="telefone_medico" type="text" value="<?php echo $results_medicos->telefone;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="celular_medico">Celular:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control celular" placeholder="Celular" data-error="Campo necessário"  required="required" name="celular_medico" id="celular_medico" type="text" value="<?php echo $results_medicos->celular;?>">
						</div>
					</div>					
					<div class="row">
						<div class="col-md-4">
					  		<label for="especialidade_medico">Especialidade:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Especialidade" data-error="Campo necessário"  required="required" name="especialidade_medico" id="especialidade_medico" type="text" value="<?php echo $results_medicos->especialidade;?>">
						</div>
					</div>	



					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvaedicao_medico">Enviar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>
