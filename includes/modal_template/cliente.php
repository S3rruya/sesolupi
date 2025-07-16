<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Novo cliente */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Novo cliente */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();


// $r = mysql_query(“SHOW TABLE STATUS LIKE ‘table_name’”);
// $row = mysql_fetch_array($r);
// $auto_increment = $row[‘Auto_increment’];


	$query_clientes = "select auto_increment from information_schema.TABLES where TABLE_NAME = 'clientes' and TABLE_SCHEMA='".DB_NAME."'";
	$results_clientes  = $database->get_row( $query_clientes );


?>
<!--html-->


<div class="element-wrapper">
	<div class="element-box">
  		<div class="loadingform"></div>
  		<div class="formarea">
			<form id="form_cadastro_cliente" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-2">
							<label for="tipo_cliente">Tipo  </label>

						</div>
						<div class="col-md-4 form-group">
							<select class="form-select" name="tipo_cliente" id="tipo_cliente" required="required">
								  <option value="M">Mensal</option>
								  <option value="A">Anual</option>
							</select>							
						</div>


						<div class="col-md-2">
							<label for="codigo_cliente">Código </label>

						</div>
						<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="codigo_cliente" id="codigo_cliente" type="number" value="<?php echo $results_clientes->auto_increment;?>">
						</div>


					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="nome_cliente">Nome:</label>
					  	</div>
					  	<div class="col-md-5 form-group">
							<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"  required="required" name="nome_cliente" id="nome_cliente" type="text">
						</div>

						<div class="col-md-2">
					  		<label for="data_nascimento_cliente">Dt de nasc.:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="data_nascimento_cliente" id="data_nascimento_cliente" type="date">
						</div>
					</div>					
					<div class="row">
						<div class="col-md-2">
					  		<label for="estado_civil_cliente">Estado Civil:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<select class="form-select" name="estado_civil_cliente" id="estado_civil_cliente" required="required">
								  <option value="1">Solteiro (a)</option>
								  <option value="2">Casado (a)</option>
								  <option value="3">Divorciado (a)</option>
								  <option value="4">Viúvo (a)</option>
								  <option value="5">Outro</option>
							</select>
						</div>
						<div class="col-md-1">
					  		<label for="sexo">Sexo:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="sexo" id="sexo" required="required">
							  <option value="Masculino">Masculino</option>
							  <option value="Feminino">Feminino</option>
							  <option value="Outros">Outros</option>
							</select>
						</div>	

						<div class="col-md-1">
					  		<label for="cor_cliente">Cor:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="cor_cliente" id="cor_cliente" required="required">
								  <option value="Branca" >Branca</option>
								  <option value="Preta" >Preta</option>
								  <option value="Parda" >Parda</option>
								  <option value="Amarela" >Amarela</option>
								  <option value="Indígena" >Indígena</option>
								  <option value="Outra">Outra</option>
							</select>
						</div>

					

					</div>	


					<div class="row">
						<div class="col-md-2">
					  		<label for="cpf_cliente">CPF:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control cpf" data-error="Campo necessário"  required="required" name="cpf_cliente" id="cpf_cliente" type="text">
						</div>
						<div class="col-md-1">
					  		<label for="rg_cliente">RG:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control rg" data-error="Campo necessário"  required="required" name="rg_cliente" id="rg_cliente" type="text">
						</div>
						<div class="col-md-1">
					  		<label for="naturalidade_cliente">Naturalid.:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="naturalidade_cliente" id="naturalidade_cliente" type="text" value="Pindamonhangabense">
						</div>	

					</div>	
					

					<div class="row">
						<div class="col-md-2">
					  		<label for="cep_cliente">CEP:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control cep" data-error="Campo necessário"  required="required" name="cep_cliente" id="cep_cliente" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="endereco_cliente">Endereço:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="endereco_cliente" id="endereco_cliente" type="text">
						</div>

						<div class="col-md-1">
					  		<label for="numero_cliente">Nº:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="numero_cliente" id="numero_cliente" type="text">
						</div>

						<div class="col-md-1">
					  		<label for="complemento_cliente">Compl.:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário" name="complemento_cliente" id="complemento_cliente" type="text">
						</div>

						<div class="col-md-2">
					  		<label for="bairro_cliente">Bairro:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="bairro_cliente" id="bairro_cliente" type="text">
						</div>


						<div class="col-md-1">
					  		<label for="cidade_cliente">Cidade:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="cidade_cliente" id="cidade_cliente" type="text">
						</div>

						<div class="col-md-1">
					  		<label for="estado_cliente">UF:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<select class="form-select" name="estado_cliente" id="estado_cliente" required="required">
							    <option value="AC">AC</option>
							    <option value="AL">AL</option>
							    <option value="AP">AP</option>
							    <option value="AM">AM</option>
							    <option value="BA">BA</option>
							    <option value="CE">CE</option>
							    <option value="DF">DF</option>
							    <option value="ES">ES</option>
							    <option value="GO">GO</option>
							    <option value="MA">MA</option>
							    <option value="MT">MT</option>
							    <option value="MS">MS</option>
							    <option value="MG">MG</option>
							    <option value="PA">PA</option>
							    <option value="PB">PB</option>
							    <option value="PR">PR</option>
							    <option value="PE">PE</option>
							    <option value="PI">PI</option>
							    <option value="RJ">RJ</option>
							    <option value="RN">RN</option>
							    <option value="RS">RS</option>
							    <option value="RO">RO</option>
							    <option value="RR">RR</option>
							    <option value="SC">SC</option>
							    <option value="SP">SP</option>
							    <option value="SE">SE</option>
							    <option value="TO">TO</option>
							</select>

						</div>
					</div>	

					<div class="row">
						<div class="col-md-2">
					  		<label for="tel_res_cliente">Tel Res:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control telefone" data-error="Campo necessário" required="required" name="tel_res_cliente" id="tel_res_cliente" type="text" value="12 ">
						</div>

						<div class="col-md-2">
					  		<label for="tel_cel_cliente">Tel Celular:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control celular" data-error="Campo necessário"  required="required" name="tel_cel_cliente" id="tel_cel_cliente" type="text" value="12 ">
						</div>
					</div>



					<div class="row">
						<div class="col-md-2">
					  		<label for="email_cliente">E-mail:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="email_cliente" id="email_cliente" type="text">
						</div>

						<div class="col-md-2">
					  		<label for="profissao_cliente">Profissão:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control " data-error="Campo necessário"  name="profissao_cliente" id="profissao_cliente" type="text">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="religiao_cliente">Religião:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="religiao_cliente" id="religiao_cliente" type="text">
						</div>

						<div class="col-md-1">
					  		<label for="adesao_cliente">Adesão:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="adesao_cliente" id="adesao_cliente" type="date" value="<?php echo date("Y-m-d");?>">
						</div>

						<div class="col-md-1">
					  		<label for="vencimento_cliente">Venc:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="vencimento_cliente" id="vencimento_cliente" required="required">
							    <option value="01">01</option>
							    <option value="02">02</option>
							    <option value="03">03</option>
							    <option value="04">04</option>
							    <option value="05">05</option>
							    <option value="06">06</option>
							    <option value="07">07</option>
							    <option value="08">08</option>
							    <option value="09">09</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>
							    <option value="13">13</option>
							    <option value="14">14</option>
							    <option value="15">15</option>
							    <option value="16">16</option>
							    <option value="17">17</option>
							    <option value="18">18</option>
							    <option value="19">19</option>
							    <option value="20">20</option>
							    <option value="21">21</option>
							    <option value="22">22</option>
							    <option value="23">23</option>
							    <option value="24">24</option>
							    <option value="25">25</option>
							    <option value="26">26</option>
							    <option value="27">27</option>
							    <option value="28">28</option>
							    <option value="29">29</option>
							    <option value="30">30</option>
							    <option value="31">31</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
					  		<label for="exampleFormControlTextarea1">Observação:</label>
					  	</div>
					  	<div class="col-md-10 form-group">
					  		 <div class="form-group with-title mb-3">
                                <textarea class="form-control" name="observacao" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                                <label class="labelfina">Detalhar de maneira clara a observação para este cliente</label>
                            </div>
						</div>
					</div>


					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvacadastro_cliente">Enviar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>
