<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Edição de dados de usuário */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Edição de dados de usuário */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

	$query_usuarios = "SELECT * FROM usuarios WHERE  usuarios.id = '".$_GET['id']."' LIMIT 1";
	$results_usuarios  = $database->get_row( $query_usuarios );
?>
<!--html-->




<div class="element-wrapper">
	<div class="element-box">
  		<div class="loadingform"></div>
  		<div class="formarea">

			<form id="form_usuario_editar" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="id_usuario" value="<?php echo $_GET['id'];?>">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-4">
							<label for="nome_usuario">Nome </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome" data-error="Campo necessário"  required="required" name="nome_usuario" id="nome_usuario" type="text" value="<?php echo $results_usuarios->nome;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="login_usuario">Login </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome de usuário" data-error="Campo necessário"  required="required" name="login_usuario" id="login_usuario" type="text" value="<?php echo $results_usuarios->login;?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="senha_usuario">Senha </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome de usuário" data-error="Campo necessário"  required="required" name="senha_usuario" id="senha_usuario" type="password" value="<?php echo $results_usuarios->senha;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="email_usuario">E-mail </label>
						</div>
						<div class="col-md-8 form-group">
							<input class="form-control" placeholder="Nome de usuário" data-error="Campo necessário"  required="required" name="email_usuario" id="email_usuario" type="email" value="<?php echo $results_usuarios->email;?>">
						</div>
					</div>



					<div class="row">
						<div class="col-md-4">
					  		<label for="telefone_usuario">Telefone:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control telefone" placeholder="Telefone" data-error="Campo necessário"  required="required" name="telefone_usuario" id="telefone_usuario" type="text" value="<?php echo $results_usuarios->telefone;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
					  		<label for="celular_usuario">Celular:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<input class="form-control celular" placeholder="Celular" data-error="Campo necessário"  required="required" name="celular_usuario" id="celular_usuario" type="text" value="<?php echo $results_usuarios->celular;?>">
						</div>
					</div>					



					<div class="row">
						<div class="col-md-4">
					  		<label for="status_usuario">Status:</label>
					  	</div>
					  	<div class="col-md-8 form-group">
							<select class="form-control" name="status_usuario" id="status_usuario" required="required">
								  <option value="1" <?php if($results_usuarios->status == "1" ){ echo "selected='selected'";}?>>Ativo</option>
								  <option value="0" <?php if($results_usuarios->status == "0" ){ echo "selected='selected'";}?>>Inativo</option>
							</select>
						</div>
					</div>	


					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvaedicao_usuario">Enviar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>
