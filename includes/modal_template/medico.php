<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Novo médico */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Novo médico */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();
?>
<!--html-->




<div class="element-wrapper">
	<div class="element-box">
  		<div class="loadingform"></div>
  		<div class="formarea">
			<form id="form_cadastro_medico" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-4">
							<label for="nome_medico">Nome </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome" data-error="Campo necessário"  required="required" name="nome_medico" id="nome_medico" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="telefone_medico">Telefone:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control telefone" placeholder="Telefone" data-error="Campo necessário"  required="required" name="telefone_medico" id="telefone_medico" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="celular_medico">Celular:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control celular" placeholder="Celular" data-error="Campo necessário"  required="required" name="celular_medico" id="celular_medico" type="text">
						</div>
					</div>					
					<div class="row">
						<div class="col-md-4">
					  		<label for="especialidade_medico">Especialidade:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Especialidade" data-error="Campo necessário"  required="required" name="especialidade_medico" id="especialidade_medico" type="text">
						</div>
					</div>	

					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvacadastro_medico">Enviar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>
