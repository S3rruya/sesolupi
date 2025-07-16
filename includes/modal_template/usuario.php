<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Novo usuário */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Novo usuário */

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
			<form id="form_cadastro_usuario" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-4">
							<label for="nome_usuario">Nome </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome" data-error="Campo necessário"  required="required" name="nome_usuario" id="nome_usuario" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="login_usuario">Login </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome de usuário" data-error="Campo necessário"  required="required" name="login_usuario" id="login_usuario" type="text">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="senha_usuario">Senha </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Senha" data-error="Campo necessário"  required="required" name="senha_usuario" id="senha_usuario" type="password">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="email_usuario">E-mail </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Email" data-error="Campo necessário"  required="required" name="email_usuario" id="email_usuario" type="email">
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
					  		<label for="telefone_usuario">Telefone:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control telefone" placeholder="Telefone" data-error="Campo necessário"  required="required" name="telefone_usuario" id="telefone_usuario" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="celular_usuario">Celular:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control celular" placeholder="Celular" data-error="Campo necessário"  required="required" name="celular_usuario" id="celular_usuario" type="text">
						</div>
					</div>					

					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvacadastro_usuario">Enviar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>
