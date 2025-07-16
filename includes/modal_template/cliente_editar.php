<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Gestão de Contrato */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Gestão de Contrato */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

	$query_clientes = "SELECT * FROM clientes WHERE  clientes.id = '".$_GET['id']."' LIMIT 1";
	$results_clientes  = $database->get_row( $query_clientes );

// echo '<pre>';
// print_r($results_clientes);
// echo '</pre>';
?>
<!--html-->

<div class="element-wrapper">
	<div class="element-box">
  		<div class="loadingform"></div>
  		<div class="formarea">
			<form id="form_cliente_editar" class="formvalidar form-horizontal" data-toggle="validator" role="form" >
				<div class="form-body">
					<input type="hidden" name="id_cliente" value="<?php echo $_GET['id'];?>">
					<input type="hidden" name="chaveup" value="<?php echo $_SESSION['rand'];?>">

					<div class="row">
						<div class="col-md-2">
							<label for="tipo_cliente">Tipo  </label>

						</div>
						<div class="col-md-4 form-group">
							<select class="form-select" name="tipo_cliente" id="tipo_cliente" required="required">
								  <option value="M" <?php if($results_clientes->tipo == "M" ){ echo "selected='selected'";}?>>Mensal</option>
								  <option value="A" <?php if($results_clientes->tipo == "A" ){ echo "selected='selected'";}?>>Anual</option>
							</select>							
						</div>


						<div class="col-md-2">
							<label for="codigo_cliente">Código </label>

						</div>
						<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="codigo_cliente" id="codigo_cliente" type="number" value="<?php echo $results_clientes->codigo_cliente;?>">
						</div>


					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="nome_cliente">Nome:</label>
					  	</div>
					  	<div class="col-md-5 form-group">
							<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"  required="required" name="nome_cliente" id="nome_cliente" type="text" value="<?php echo $results_clientes->nome;?>">
						</div>

						<div class="col-md-2">
					  		<label for="data_nascimento_cliente">Dt de nasc.:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="data_nascimento_cliente" id="data_nascimento_cliente" type="date" value="<?php echo $results_clientes->data_nascimento;?>">
						</div>
					</div>					
					<div class="row">
						<div class="col-md-2">
					  		<label for="estado_civil_cliente">Estado Civil:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<select class="form-select" name="estado_civil_cliente" id="estado_civil_cliente" required="required">
								  <option value="1" <?php if($results_clientes->estado_civil == "1" ){ echo "selected='selected'";}?>>Solteiro (a)</option>
								  <option value="2" <?php if($results_clientes->estado_civil == "2" ){ echo "selected='selected'";}?>>Casado (a)</option>
								  <option value="3" <?php if($results_clientes->estado_civil == "3" ){ echo "selected='selected'";}?>>Divorciado (a)</option>
								  <option value="4" <?php if($results_clientes->estado_civil == "4" ){ echo "selected='selected'";}?>>Viúvo (a)</option>
								  <option value="5" <?php if($results_clientes->estado_civil == "5" ){ echo "selected='selected'";}?>>Outro</option>
							</select>
						</div>

						<div class="col-md-1">
					  		<label for="sexo">Sexo:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="sexo" id="sexo" required="required">
							  <option value="Masculino" <?php if($results_clientes->sexo == "Masculino" ){ echo "selected='selected'";}?>>Masculino</option>
							  <option value="Feminino" <?php if($results_clientes->sexo == "Feminino" ){ echo "selected='selected'";}?>>Feminino</option>
							  <option value="Outros" <?php if($results_clientes->sexo == "Outros" ){ echo "selected='selected'";}?>>Outros</option>
							</select>
						</div>	

						<div class="col-md-1">
					  		<label for="cor">Cor:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="cor" id="cor" required="required">
								  <option value="Branca" <?php if($results_clientes->cor == "Branca" ){ echo "selected='selected'";}?>>Branca</option>
								  <option value="Preta" <?php if($results_clientes->cor == "Preta" ){ echo "selected='selected'";}?>>Preta</option>
								  <option value="Parda" <?php if($results_clientes->cor == "Parda" ){ echo "selected='selected'";}?>>Parda</option>
								  <option value="Amarela" <?php if($results_clientes->cor == "Amarela" ){ echo "selected='selected'";}?>>Amarela</option>
								  <option value="Indígena" <?php if($results_clientes->cor == "Indígena" ){ echo "selected='selected'";}?>>Indígena</option>
								  <option value="Outra" <?php if($results_clientes->cor == "Outra" ){ echo "selected='selected'";}?>>Outra</option>
							</select>
						</div>



					</div>	


					<div class="row">
						<div class="col-md-2">
					  		<label for="cpf_cliente">CPF:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control cpf" data-error="Campo necessário"  required="required" name="cpf_cliente" id="cpf_cliente" type="text" value="<?php echo $results_clientes->cpf;?>">
						</div>
						<div class="col-md-1">
					  		<label for="rg_cliente">RG:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control rg" data-error="Campo necessário"  required="required" name="rg_cliente" id="rg_cliente" type="text" value="<?php echo $results_clientes->rg;?>">
						</div>

						<div class="col-md-1">
					  		<label for="naturalidade">Naturalid:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="naturalidade" id="naturalidade" type="text" value="<?php echo $results_clientes->naturalidade;?>">
						</div>
					</div>	
					

					<div class="row">
						<div class="col-md-2">
					  		<label for="cep_cliente">CEP:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control cep" data-error="Campo necessário"  required="required" name="cep_cliente" id="cep_cliente" type="text" value="<?php echo $results_clientes->cep;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="endereco_cliente">Endereço:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="endereco_cliente" id="endereco_cliente" type="text" value="<?php echo $results_clientes->endereco;?>">
						</div>

						<div class="col-md-1">
					  		<label for="numero_cliente">Nº:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="numero_cliente" id="numero_cliente" type="text" value="<?php echo $results_clientes->numero;?>">
						</div>

						<div class="col-md-1">
					  		<label for="complemento_cliente">Compl.:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário" name="complemento_cliente" id="complemento_cliente" type="text" value="<?php echo $results_clientes->complemento;?>">
						</div>

						<div class="col-md-2">
					  		<label for="bairro_cliente">Bairro:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="bairro_cliente" id="bairro_cliente" type="text" value="<?php echo $results_clientes->bairro;?>">
						</div>


						<div class="col-md-1">
					  		<label for="cidade_cliente">Cidade:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="cidade_cliente" id="cidade_cliente" type="text" value="<?php echo $results_clientes->cidade;?>">
						</div>

						<div class="col-md-1">
					  		<label for="estado_cliente">UF:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<select class="form-select" name="estado_cliente" id="estado_cliente" required="required">
							    <option value="AC" <?php if($results_clientes->estado == "AC" ){ echo "selected='selected'";}?>>AC</option>
							    <option value="AL" <?php if($results_clientes->estado == "AL" ){ echo "selected='selected'";}?>>AL</option>
							    <option value="AP" <?php if($results_clientes->estado == "AP" ){ echo "selected='selected'";}?>>AP</option>
							    <option value="AM" <?php if($results_clientes->estado == "AM" ){ echo "selected='selected'";}?>>AM</option>
							    <option value="BA" <?php if($results_clientes->estado == "BA" ){ echo "selected='selected'";}?>>BA</option>
							    <option value="CE" <?php if($results_clientes->estado == "CE" ){ echo "selected='selected'";}?>>CE</option>
							    <option value="DF" <?php if($results_clientes->estado == "DF" ){ echo "selected='selected'";}?>>DF</option>
							    <option value="ES" <?php if($results_clientes->estado == "ES" ){ echo "selected='selected'";}?>>ES</option>
							    <option value="GO" <?php if($results_clientes->estado == "GO" ){ echo "selected='selected'";}?>>GO</option>
							    <option value="MA" <?php if($results_clientes->estado == "MA" ){ echo "selected='selected'";}?>>MA</option>
							    <option value="MT" <?php if($results_clientes->estado == "MT" ){ echo "selected='selected'";}?>>MT</option>
							    <option value="MS" <?php if($results_clientes->estado == "MS" ){ echo "selected='selected'";}?>>MS</option>
							    <option value="MG" <?php if($results_clientes->estado == "MG" ){ echo "selected='selected'";}?>>MG</option>
							    <option value="PA" <?php if($results_clientes->estado == "PA" ){ echo "selected='selected'";}?>>PA</option>
							    <option value="PB" <?php if($results_clientes->estado == "PB" ){ echo "selected='selected'";}?>>PB</option>
							    <option value="PR" <?php if($results_clientes->estado == "PR" ){ echo "selected='selected'";}?>>PR</option>
							    <option value="PE" <?php if($results_clientes->estado == "PE" ){ echo "selected='selected'";}?>>PE</option>
							    <option value="PI" <?php if($results_clientes->estado == "PI" ){ echo "selected='selected'";}?>>PI</option>
							    <option value="RJ" <?php if($results_clientes->estado == "RJ" ){ echo "selected='selected'";}?>>RJ</option>
							    <option value="RN" <?php if($results_clientes->estado == "RN" ){ echo "selected='selected'";}?>>RN</option>
							    <option value="RS" <?php if($results_clientes->estado == "RS" ){ echo "selected='selected'";}?>>RS</option>
							    <option value="RO" <?php if($results_clientes->estado == "RO" ){ echo "selected='selected'";}?>>RO</option>
							    <option value="RR" <?php if($results_clientes->estado == "RR" ){ echo "selected='selected'";}?>>RR</option>
							    <option value="SC" <?php if($results_clientes->estado == "SC" ){ echo "selected='selected'";}?>>SC</option>
							    <option value="SP" <?php if($results_clientes->estado == "SP" ){ echo "selected='selected'";}?>>SP</option>
							    <option value="SE" <?php if($results_clientes->estado == "SE" ){ echo "selected='selected'";}?>>SE</option>
							    <option value="TO" <?php if($results_clientes->estado == "TO" ){ echo "selected='selected'";}?>>TO</option>
							</select>

						</div>
					</div>	

					<div class="row">
						<div class="col-md-2">
					  		<label for="tel_res_cliente">Tel Res:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control telefone" data-error="Campo necessário" required="required" name="tel_res_cliente" id="tel_res_cliente" type="text" value="<?php echo $results_clientes->tel_res;?>">
						</div>

						<div class="col-md-2">
					  		<label for="tel_cel_cliente">Tel Celular:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control celular" data-error="Campo necessário"  required="required" name="tel_cel_cliente" id="tel_cel_cliente" type="text" value="<?php echo $results_clientes->tel_cel;?>">
						</div>
					</div>



					<div class="row">
						<div class="col-md-2">
					  		<label for="email_cliente">E-mail:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="email_cliente" id="email_cliente" type="text" value="<?php echo $results_clientes->email;?>">
						</div>

						<div class="col-md-2">
					  		<label for="profissao_cliente">Profissão:</label>
					  	</div>
					  	<div class="col-md-4 form-group">
							<input class="form-control " data-error="Campo necessário"  name="profissao_cliente" id="profissao_cliente" type="text" value="<?php echo $results_clientes->profissao;?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="religiao_cliente">Religião:</label>
					  	</div>
					  	<div class="col-md-2 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="religiao_cliente" id="religiao_cliente" type="text" value="<?php echo $results_clientes->religiao;?>">
						</div>

						<div class="col-md-1">
					  		<label for="adesao_cliente">Adesão:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<input class="form-control" data-error="Campo necessário"  required="required" name="adesao_cliente" id="adesao_cliente" type="date" value="<?php echo $results_clientes->dt_adesao;?>">
						</div>

						<div class="col-md-1">
					  		<label for="vencimento_cliente">Venc:</label>
					  	</div>
					  	<div class="col-md-3 form-group">
							<select class="form-select" name="vencimento_cliente" id="vencimento_cliente" required="required">
							    <option value="01" <?php if($results_clientes->vencimento == "01" ){ echo "selected='selected'";}?>>01</option>
							    <option value="02" <?php if($results_clientes->vencimento == "02" ){ echo "selected='selected'";}?>>02</option>
							    <option value="03" <?php if($results_clientes->vencimento == "03" ){ echo "selected='selected'";}?>>03</option>
							    <option value="04" <?php if($results_clientes->vencimento == "04" ){ echo "selected='selected'";}?>>04</option>
							    <option value="05" <?php if($results_clientes->vencimento == "05" ){ echo "selected='selected'";}?>>05</option>
							    <option value="06" <?php if($results_clientes->vencimento == "06" ){ echo "selected='selected'";}?>>06</option>
							    <option value="07" <?php if($results_clientes->vencimento == "07" ){ echo "selected='selected'";}?>>07</option>
							    <option value="08" <?php if($results_clientes->vencimento == "08" ){ echo "selected='selected'";}?>>08</option>
							    <option value="09" <?php if($results_clientes->vencimento == "09" ){ echo "selected='selected'";}?>>09</option>
							    <option value="10" <?php if($results_clientes->vencimento == "10" ){ echo "selected='selected'";}?>>10</option>
							    <option value="11" <?php if($results_clientes->vencimento == "11" ){ echo "selected='selected'";}?>>11</option>
							    <option value="12" <?php if($results_clientes->vencimento == "12" ){ echo "selected='selected'";}?>>12</option>
							    <option value="13" <?php if($results_clientes->vencimento == "13" ){ echo "selected='selected'";}?>>13</option>
							    <option value="14" <?php if($results_clientes->vencimento == "14" ){ echo "selected='selected'";}?>>14</option>
							    <option value="15" <?php if($results_clientes->vencimento == "15" ){ echo "selected='selected'";}?>>15</option>
							    <option value="16" <?php if($results_clientes->vencimento == "16" ){ echo "selected='selected'";}?>>16</option>
							    <option value="17" <?php if($results_clientes->vencimento == "17" ){ echo "selected='selected'";}?>>17</option>
							    <option value="18" <?php if($results_clientes->vencimento == "18" ){ echo "selected='selected'";}?>>18</option>
							    <option value="19" <?php if($results_clientes->vencimento == "19" ){ echo "selected='selected'";}?>>19</option>
							    <option value="20" <?php if($results_clientes->vencimento == "20" ){ echo "selected='selected'";}?>>20</option>
							    <option value="21" <?php if($results_clientes->vencimento == "21" ){ echo "selected='selected'";}?>>21</option>
							    <option value="22" <?php if($results_clientes->vencimento == "22" ){ echo "selected='selected'";}?>>22</option>
							    <option value="23" <?php if($results_clientes->vencimento == "23" ){ echo "selected='selected'";}?>>23</option>
							    <option value="24" <?php if($results_clientes->vencimento == "24" ){ echo "selected='selected'";}?>>24</option>
							    <option value="25" <?php if($results_clientes->vencimento == "25" ){ echo "selected='selected'";}?>>25</option>
							    <option value="26" <?php if($results_clientes->vencimento == "26" ){ echo "selected='selected'";}?>>26</option>
							    <option value="27" <?php if($results_clientes->vencimento == "27" ){ echo "selected='selected'";}?>>27</option>
							    <option value="28" <?php if($results_clientes->vencimento == "28" ){ echo "selected='selected'";}?>>28</option>
							    <option value="29" <?php if($results_clientes->vencimento == "29" ){ echo "selected='selected'";}?>>29</option>
							    <option value="30" <?php if($results_clientes->vencimento == "30" ){ echo "selected='selected'";}?>>30</option>
							    <option value="31" <?php if($results_clientes->vencimento == "31" ){ echo "selected='selected'";}?>>31</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
					  		<label for="exampleFormControlTextarea1">Observação:</label>
					  	</div>
					  	<div class="col-md-10 form-group">
					  		 <div class="form-group with-title mb-3">
                                <textarea class="form-control" name="observacao"  id="exampleFormControlTextarea1"
                                    rows="3"><?php echo $results_clientes->observacao;?></textarea>
                                <label>Detalhar de maneira clara a observação para este cliente</label>
                            </div>
						</div>
					</div>


					<div class="form-buttons-w text-right">
					  <button class="btn btn-primary salvaedicao_cliente">Salvar</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>