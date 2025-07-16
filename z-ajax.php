<?php
@session_start();

include_once("classes/load_classes.php");


//CONTEUDO DE MODAL
if (@$_REQUEST['action'] == "modalcontent"){
	$mtype 			= $_REQUEST['mtype'];
	$id 			= $_REQUEST['id'];
	modalcontent($mtype, $id);
}

function modalcontent($mtype, $id){
	@session_start();
	header('Content-Type: application/json');
	$database = new DB();

	$tipodeacesso = checkfileperm("includes/modal_template/".$_REQUEST['mtype'].".php",1);
	$titulomodal = gettitulomodal("includes/modal_template/".$_REQUEST['mtype'].".php",2);
	$check_niveldeacesso = $_SESSION['fran_levelaccess'];

	if($tipodeacesso <= $check_niveldeacesso){
		$string = 1;
		
	}else{
		$string = 0;
	}

	$retorno['0']['return'] = $string;
	$retorno['0']['titulo'] = $titulomodal;
	$retorno['0']['conteudo'] = $string;
	$retorno['0']['bt'] = 'botao';
	
	echo json_encode($retorno);
	//return $retornoaqui;

	
	// SALVANDO REGISTRO 
	criar_log($mtype, $id);


	die();
}






//SALVANDO DADOS - CLIENTE
if (@$_REQUEST['action'] == "cliente_novo"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	cliente_novo($valores, $usuario);
}

function cliente_novo($valores, $usuario){
	@session_start();
	$database = new DB();

	$data = date("Y-m-d G:i:s");
	$user_data = array(
		
		'tipo' =>  $valores['tipo_cliente'],
		'codigo_cliente' => $valores['codigo_cliente'],
		'nome' => addslashes($valores['nome_cliente']), 
		'data_nascimento' => $valores['data_nascimento_cliente'],
		'dt_adesao' => $valores['adesao_cliente'],
		'estado_civil' => $valores['estado_civil_cliente'],
		'cor' => $valores['cor'],
		'sexo' => $valores['sexo'],
		'naturalidade' => $valores['naturalidade'],
		'cpf' => $valores['cpf_cliente'],
		'rg' => $valores['rg_cliente'],
		'endereco' => addslashes($valores['endereco_cliente']), 
		'numero' => $valores['numero_cliente'],	
		'complemento' => addslashes($valores['complemento_cliente']), 
		'bairro' => addslashes($valores['bairro_cliente']), 
		'cidade' => addslashes($valores['cidade_cliente']), 
		'cep' => $valores['cep_cliente'],
		'estado' => $valores['estado_cliente'],
		'tel_res' => $valores['tel_res_cliente'],
		'tel_cel' => $valores['tel_cel_cliente'],
		'email' => addslashes($valores['email_cliente']), 
		'profissao' => addslashes($valores['profissao_cliente']), 
		'religiao' => addslashes($valores['religiao_cliente']), 
		'vencimento' => $valores['vencimento_cliente'],
		'observacao' => addslashes($valores['observacao']),
	 );
	$database->insert('clientes', $user_data );
	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	$diabase =  $valores['vencimento_cliente'];

	//criando contrato
	$contrato = criandocontrato($last, $valores['tipo_cliente']);

	//gerando financeiro
	criarregistros($last, $valores['tipo_cliente'], $diabase, $contrato);


	criar_log('cliente_novo', $last);
	die();

}

//SALVANDO DADOS - EDIÇÃO - CLIENTE
if (@$_REQUEST['action'] == "cliente_editar"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	cliente_editar($valores, $usuario);
}

function cliente_editar($valores, $usuario){
	@session_start();
	$database = new DB();

	//salvando demais infos
	$user_data = array(
		'tipo' =>  $valores['tipo_cliente'],
		'codigo_cliente' => $valores['codigo_cliente'],
		'nome' => addslashes($valores['nome_cliente']), 
		'data_nascimento' => $valores['data_nascimento_cliente'],
		'dt_adesao' => $valores['adesao_cliente'],
		'estado_civil' => $valores['estado_civil_cliente'],
		'cor' => $valores['cor'],
		'sexo' => $valores['sexo'],
		'naturalidade' => $valores['naturalidade'],
		'cpf' => $valores['cpf_cliente'],
		'rg' => $valores['rg_cliente'],
		'endereco' => addslashes($valores['endereco_cliente']), 
		'numero' => $valores['numero_cliente'],	
		'complemento' => addslashes($valores['complemento_cliente']), 
		'bairro' => addslashes($valores['bairro_cliente']), 
		'cidade' => addslashes($valores['cidade_cliente']), 
		'cep' => $valores['cep_cliente'],
		'estado' => $valores['estado_cliente'],
		'tel_res' => $valores['tel_res_cliente'],
		'tel_cel' => $valores['tel_cel_cliente'],
		'email' => addslashes($valores['email_cliente']), 
		'profissao' => addslashes($valores['profissao_cliente']), 
		'religiao' => addslashes($valores['religiao_cliente']), 
		'vencimento' => $valores['vencimento_cliente'],
		'observacao' => addslashes($valores['observacao'])
	 );
	$where_clause = array('id' => $valores['id_cliente']);
	$updated = $database->update( 'clientes', $user_data, $where_clause, '' );

	$afetadas = $database->affected();

	// SALVANDO REGISTRO 
	criar_log('cliente_editar', $valores['id_cliente']);

	print_r($afetadas);
	die();

}



if (@$_REQUEST['action'] == "formfinanceiro"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_REQUEST;
	formfinanceiro($valores, $usuario);
}
function formfinanceiro($valores, $usuario){

	@session_start();
	$database = new DB();

	$query_dados = "SELECT * FROM financeiro WHERE  financeiro.id = '".$valores['id']."' LIMIT 1";
	$results_dados  = $database->get_row( $query_dados );

	//print_r($results_dados);


	if($results_dados->dt_pagamento != "0000-00-00"){ $dt_pagamento = $results_dados->dt_pagamento;}else{ $dt_pagamento = date("Y-m-d");}
	if($results_dados->valor_pagamento != "0.00"){ $valor_pagamento = $results_dados->valor_pagamento;}else{ $valor_pagamento = $results_dados->valor;}


	$var = "  
            <div class=\"card-header\">
                <h4 class=\"card-title\">Atualizando dados</h4>
            </div>
		<div class=\"loadingform_inmodal\"></div>
  					<div class=\"formarea_inmodal\">
                    <form id=\"form_salvaedicao_financeiro\" class=\"form form-horizontal\">
                    	<input type=\"hidden\" name=\"id_financeiro\" value=\"".$results_dados->id."\">
                    	<input type=\"hidden\" name=\"referencia_financeiro\" value=\"".$valores['id']."\">
                        <div class=\"form-body\">
                            <div class=\"row\">

                                <div class=\"col-md-2\">
                                     <label>Dt. recebimento:</label>
                                </div>
                                <div class=\"col-md-2 form-group\">
                                    <input type=\"date\" id=\"dt_pagamento\" class=\"form-control\" name=\"dt_pagamento\" value=\"".$dt_pagamento."\">
                                </div>

                                <div class=\"col-md-1\">
                                     <label>Valor:</label>
                                </div>
                                <div class=\"col-md-2 form-group\">
                                    <input type=\"text\" id=\"valor_pagamento\" class=\"form-control money2\" name=\"valor_pagamento\" value=\"".$valor_pagamento."\">
                                </div>


                                <div class=\"col-md-1\">
                                    <label>Status</label>
                                </div>
                                <div class=\"col-md-2 form-group\">
			 						<select class=\"form-select\" name=\"status_financeiro\" id=\"status_financeiro\" required=\"required\">";

										$var.="<option value=\"1\" "; if($results_dados->status == "1"){ $var.="selected='selected'";} $var.=">Aguardando</option>";
										$var.="<option value=\"2\" "; if($results_dados->status == "2" OR $results_dados->status == "7"){ $var.="selected='selected'";} $var.=">Recebido</option>";
										$var.="<option value=\"3\" "; if($results_dados->status == "3"){ $var.="selected='selected'";} $var.=">Cancelado</option>";
										$var.="<option value=\"6\" "; if($results_dados->status == "6"){ $var.="selected='selected'";} $var.=">Estornado</option>";

	$var.=" 						</select>
                                </div>

							
                                <div class=\"col-sm-2 d-flex justify-content-end\">
                                    <button class=\"btn btn-primary salvaedicao_financeiro\">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                	</div>";

echo $var;

	die();
}


//SALVANDO DADOS - MEDICO
if (@$_REQUEST['action'] == "salvaedicao_financeiro"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	salvaedicao_financeiro($valores, $usuario);
}

function salvaedicao_financeiro($valores, $usuario){
	@session_start();
	$database = new DB();

	if(@$valores['obito_dependente'] != ""){$obito_db = $valores['obito_dependente'];}else{$obito_db = '0'; }

	$data = date("Y-m-d G:i:s");
	$user_data = array(
		
		'dt_pagamento' => $valores['dt_pagamento'],
		'valor_pagamento' => $valores['valor_pagamento'],
		'status' => $valores['status_financeiro'],
	 );

	$where_clause = array('id' => $valores['id_financeiro']);
	$updated = $database->update( 'financeiro', $user_data, $where_clause, '' );

	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	criar_log('salvaedicao_financeiro', $last);
	die();

}








//SALVANDO DADOS - DEPENDENTE
if (@$_REQUEST['action'] == "salva_dependente"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	salva_dependente($valores, $usuario);
}

function salva_dependente($valores, $usuario){
	@session_start();
	$database = new DB();

	$data = date("Y-m-d G:i:s");
	$user_data = array(
	
		'nome' => addslashes($valores['nome_dependente']), 
		'cpf' =>  $valores['cpf_dependente'],
		'dt_nascimento' =>  $valores['dt_nascimento_dependente'],
		'parentesco' => $valores['parentesco_dependente'],
		'dt_adesao' => $valores['dt_adesao_dependente'],
		'referencia' => $valores['referencia_dependente'],
	 );
	$database->insert('dependentes', $user_data );
	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	criar_log('salva_dependente', $last);
	die();

}




if (@$_REQUEST['action'] == "formdependente"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_REQUEST;
	formdependente($valores, $usuario);
}
function formdependente($valores, $usuario){

	@session_start();
	$database = new DB();

	$query_dados = "SELECT * FROM dependentes WHERE  dependentes.id = '".$valores['id']."' LIMIT 1";
	$results_dados  = $database->get_row( $query_dados );

	//print_r($results_dados->id);
	$var = "  	<div class=\"loadingform_inmodal\"></div>
  					<div class=\"formarea_inmodal\">
                    <form id=\"form_salvaedicao_dependente\" class=\"form form-horizontal\">
                    	<input type=\"hidden\" name=\"id_dependente\" value=\"".$results_dados->id."\">
                    	<input type=\"hidden\" name=\"referencia_dependente\" value=\"".$valores['id']."\">
                        <div class=\"form-body\">
                            <div class=\"row\">
                                <div class=\"col-md-2\">
                                    <label>Nome</label>
	         	                </div>
                                <div class=\"col-md-4 form-group\">
                                    <input type=\"text\" id=\"nome_dependente\" class=\"form-control\" name=\"nome_dependente\" value=\"".$results_dados->nome."\">
                                </div>
                                <div class=\"col-md-2\">
                                    <label>CPF.</label>
                                </div>
                                <div class=\"col-md-4 form-group\">
                                    <input type=\"text\" id=\"cpf_dependente\" class=\"form-control cpf\" name=\"cpf_dependente\" value=\"".$results_dados->cpf."\">
                                </div>
                                <div class=\"col-md-2\">
                                    <label>Dt. Nasc.</label>
                                </div>
                                <div class=\"col-md-4 form-group\">
                                    <input type=\"date\" id=\"dt_nascimento_dependente\" class=\"form-control\" name=\"dt_nascimento_dependente\" value=\"".$results_dados->dt_nascimento."\">
                                </div>
                                <div class=\"col-md-2\">
                                    <label>Parentesco</label>
                                </div>
                                <div class=\"col-md-4 form-group\">
			 						<select class=\"form-select\" name=\"parentesco_dependente\" id=\"parentesco_dependente\" required=\"required\">";

										$var.="<option value=\"1\" "; if($results_dados->parentesco == "1"){ $var.="selected='selected'";} $var.=">Cônjuge</option>";
										$var.="<option value=\"2\" "; if($results_dados->parentesco == "2"){ $var.="selected='selected'";} $var.=">Companheiro</option>";
										$var.="<option value=\"3\" "; if($results_dados->parentesco == "3"){ $var.="selected='selected'";} $var.=">Filho (a)</option>";
										$var.="<option value=\"4\" "; if($results_dados->parentesco == "4"){ $var.="selected='selected'";} $var.=">Pai</option>";
										$var.="<option value=\"5\" "; if($results_dados->parentesco == "5"){ $var.="selected='selected'";} $var.=">Mae</option>";
										$var.="<option value=\"6\" "; if($results_dados->parentesco == "6"){ $var.="selected='selected'";} $var.=">Irmão (a)</option>";

										$var.="<option value=\"7\" "; if($results_dados->parentesco == "7"){ $var.="selected='selected'";} $var.=">Sogro (a)</option>";
										$var.="<option value=\"8\" "; if($results_dados->parentesco == "8"){ $var.="selected='selected'";} $var.=">Neto (a)</option>";
										$var.="<option value=\"9\" "; if($results_dados->parentesco == "9"){ $var.="selected='selected'";} $var.=">Bisneto (a)</option>";
										$var.="<option value=\"10\" "; if($results_dados->parentesco == "10"){ $var.="selected='selected'";} $var.=">Sobrinho (a)</option>";

										$var.="<option value=\"99\" "; if($results_dados->parentesco == "99"){ $var.="selected='selected'";} $var.=">Outro (a)</option>";

	$var.=" 						</select>
                                </div>
                                <div class=\"col-md-2\">
                                     <label>Dt. Adesão</label>
                                </div>
                                <div class=\"col-md-4 form-group\">
                                    <input type=\"date\" id=\"dt_adesao_dependente\" class=\"form-control\" name=\"dt_adesao_dependente\" value=\"".$results_dados->dt_adesao."\">
                                </div>

								
								<div class=\"col-md-2\">
                                    <label for=\"obito_dependente\">Óbito</label>
	         	                </div>
                                <div class=\"col-md-4 form-group\">
									<div class=\"checkbox\">
									    <input type=\"checkbox\" name=\"obito_dependente\" id=\"obito_dependente\" class=\"form-check-input\" value=\"1\" ";
									    if($results_dados->obito == "1"){ $var.="checked";} 
	$var.=">
									</div>
                                </div>
                                <div class=\"col-md-2\">
                                    <label>Dt. Óbito.</label>
                                </div>
                                <div class=\"col-md-4 form-group\">
                                    <input type=\"date\" id=\"dt_falecimento_dependente\" class=\"form-control\" name=\"dt_falecimento_dependente\" value=\"".$results_dados->dt_falecimento."\">
                                </div>



								<div class=\"col-md-2\">
                                    <label>Causa:</label>
	         	                </div>
                                <div class=\"col-md-10 form-group\">
                                    <textarea class=\"form-control\" name=\"observacao_dependente\" id=\"observacao_dependente\" rows=\"3\">".$results_dados->observacao."</textarea>
                                </div>


                                <div class=\"col-sm-12 d-flex justify-content-end\">
                                    <button class=\"btn btn-primary salvaedicao_dependente\">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                	</div>";

echo $var;

	die();
}
/*


*/


//SALVANDO DADOS - MEDICO
if (@$_REQUEST['action'] == "salvaedicao_dependente"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	salvaedicao_dependente($valores, $usuario);
}

function salvaedicao_dependente($valores, $usuario){
	@session_start();
	$database = new DB();

	if(@$valores['obito_dependente'] != ""){$obito_db = $valores['obito_dependente'];}else{$obito_db = '0'; }

	$data = date("Y-m-d G:i:s");
	$user_data = array(
		'nome' => addslashes($valores['nome_dependente']), 
		'cpf' => $valores['cpf_dependente'],
		'dt_nascimento' => $valores['dt_nascimento_dependente'],
		'parentesco' => $valores['parentesco_dependente'],
		'dt_adesao' => $valores['dt_adesao_dependente'],
		'obito' => $obito_db,
		'dt_falecimento' => $valores['dt_falecimento_dependente'],
		'observacao' => $valores['observacao_dependente']
	 );

	$where_clause = array('id' => $valores['id_dependente']);
	$updated = $database->update( 'dependentes', $user_data, $where_clause, '' );

	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	criar_log('salvaedicao_dependente', $last);
	die();

}


//SALVANDO DADOS - MEDICO
if (@$_REQUEST['action'] == "medico_novo"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	medico_novo($valores, $usuario);
}

function medico_novo($valores, $usuario){
	@session_start();
	$database = new DB();

	$data = date("Y-m-d G:i:s");
	$user_data = array(
		'nome' => addslashes($valores['nome_medico']), 
		'telefone' => $valores['telefone_medico'],
		'celular' => $valores['celular_medico'],
		'especialidade' => addslashes($valores['especialidade_medico']), 
		'status' => '1'
	 );
	 $database->insert('medicos', $user_data );
	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	criar_log('medico_novo', $last);
	die();

}

//SALVANDO DADOS - EDIÇÃO - MEDICO
if (@$_REQUEST['action'] == "medico_editar"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	medico_editar($valores, $usuario);
}

function medico_editar($valores, $usuario){
	@session_start();
	$database = new DB();

	//salvando demais infos
	$user_data = array(
		'nome' => addslashes($valores['nome_medico']), 
		'telefone' => $valores['telefone_medico'],
		'celular' => $valores['celular_medico'],
		'especialidade' => addslashes($valores['especialidade_medico']), 
		'status' => $valores['status_medico']
	 );
	$where_clause = array('id' => $valores['id_medico']);
	$updated = $database->update( 'medicos', $user_data, $where_clause, '' );

	$afetadas = $database->affected();

	// SALVANDO REGISTRO 
	criar_log('edicao_medico', $valores['id_medico']);

	print_r($afetadas);
	die();

}














//SALVANDO DADOS - USUÁRIO
if (@$_REQUEST['action'] == "usuario_novo"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	usuario_novo($valores, $usuario);
}

function usuario_novo($valores, $usuario){
	@session_start();
	$database = new DB();

	$data = date("Y-m-d G:i:s");
	$user_data = array(
		'login' => $valores['login_usuario'],
		'senha' => $valores['senha_usuario'],
		'nome' => addslashes($valores['nome_usuario']), 
		'email' => addslashes($valores['email_usuario']), 
		'telefone' => $valores['telefone_usuario'],
		'celular' => $valores['celular_usuario'],
		'nivel' => '90',
		'status' => '1'
	 );
	 $database->insert('usuarios', $user_data );
	$afetadas = $database->affected();
	print_r($afetadas);

	// SALVANDO REGISTRO 
	$last = $database->lastid();
	criar_log('usuario_novo', $last);
	die();

}

//SALVANDO DADOS - EDIÇÃO - USUÁRIO
if (@$_REQUEST['action'] == "usuario_editar"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	usuario_editar($valores, $usuario);
}

function usuario_editar($valores, $usuario){
	@session_start();
	$database = new DB();

	//salvando demais infos
	$user_data = array(
		'login' => $valores['login_usuario'],
		'senha' => $valores['senha_usuario'],
		'nome' => addslashes($valores['nome_usuario']), 
		'email' => addslashes($valores['email_usuario']), 
		'telefone' => $valores['telefone_usuario'],
		'celular' => $valores['celular_usuario'],
		'status' => $valores['status_usuario']
	 );
	$where_clause = array('id' => $valores['id_usuario']);
	$updated = $database->update( 'usuarios', $user_data, $where_clause, '' );

	$afetadas = $database->affected();

	// SALVANDO REGISTRO 
	criar_log('edicao_usuario', $valores['id_usuario']);

	print_r($afetadas);
	die();

}



//LISTANDO CLIENTES
if (@$_REQUEST['action'] == "getclients"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	getclients($valores, $usuario);
}

function getclients($valores, $usuario){
	
	header('Content-Type: application/json');
	$database = new DB();


	$clientes_parciais = "SELECT id,codigo_cliente, tipo, nome, tel_res, tel_cel, status, dt_adesao FROM clientes ORDER by dt_adesao DESC";
	$resultados_clientes_parciais = $database->get_results($clientes_parciais);

	
   	foreach ($resultados_clientes_parciais as $key ) {

   		$iduser = $key['id'];
   		$numero_dependentes  = $database->num_rows(  "SELECT id FROM dependentes WHERE referencia = ".$iduser."" );
   		

		if($key['status'] == "1"){
			$status = '<span class="badge bg-primary">Ativo</span>';
		}else{
			$status = '<span class="badge bg-secondary">Inativo</span>';
		}

		$tipocli = '<div class="col-2 avatar avatar-lg tipocliente">'.$key['tipo'].'</div>';


     	$action = '<a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_dependentes"><span class="badge bg-light-primary"><i class="fas fa-child"></i> Dependentes ('.$numero_dependentes.')</span></a>
        <a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_editar"><span class="badge bg-light-primary"><i class="fab fa-wpforms"></i> Ficha</span></a>
     	<a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_contrato" print="1"><span class="badge bg-light-primary"><i class="far fa-file-word"></i> Contrato</span></a>
        <a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_carterinha" print="1"><span class="badge bg-light-primary"><i class="fas fa-calendar-check"></i> Carteirinha</span></a>
        <a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_financeiro"><span class="badge bg-light-primary"><i class="fas fa-money-check-alt"></i> Financeiro</span></a>';
        //<a href="#" class="open_modal" id="'.$key['id'].'" mtype="cliente_obito"><span class="badge bg-light-primary"><i class="fas fas fa-cross"></i> Óbito</span></a>'; 

        $action .= '   <div class="btn-group mb-1">
                <div class="dropdown">
                    <a class="badge bg-light-primary dropdown-toggle me-1 " type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                       <i class="fas fas fa-cross"></i>  Óbito
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item open_modal" id="'.$key['id'].'" mtype="cliente_obito" href="#">Registrar</a>
                        <a class="dropdown-item open_modal" id="'.$key['id'].'" mtype="cliente_obito_documentos" href="#">Documentos</a>
                    </div>
                </div>
            </div>';


     $data[] = array(
       "codigo_cliente" => $key['codigo_cliente'],
	   "tipo" => $tipocli,
       "nome" => $key['nome'],
       "tel_res" => $key['tel_res'],
       "tel_cel" => $key['tel_cel'],
       "status" => $status,
       "action" => $action
     );
   }

	$data = array('data' => @$data );

	
	echo json_encode($data);

	
	die();

}

	
//LISTANDO DEPENDENTES
if (@$_REQUEST['action'] == "getdependentes"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	getdependentes($valores, $usuario);
}

function getdependentes($valores, $usuario){
	
	header('Content-Type: application/json');
	$database = new DB();


	$clientes_parciais = "SELECT dependentes.*, parentesco.nome AS nomeparentesco,

	DATE_FORMAT(dependentes.dt_nascimento,'%d/%m/%Y ') AS nice_dt_nascimento,
	DATE_FORMAT(dependentes.dt_adesao,'%d/%m/%Y ') AS nice_dt_adesao,
	DATE_FORMAT(dependentes.dt_falecimento,'%d/%m/%Y ') AS nice_dt_falecimento

	FROM dependentes 
	LEFT JOIN parentesco ON parentesco.id = dependentes.parentesco
	WHERE referencia='".$_GET['referencia']."' ORDER by parentesco ASC";
	$resultados_clientes_parciais = $database->get_results($clientes_parciais);

	
   	foreach ($resultados_clientes_parciais as $key ) {

   		$iduser = $key['id'];
   		$numero_dependentes  = $database->num_rows(  "SELECT id FROM dependentes WHERE referencia = ".$iduser."" );
   		

		if($key['obito'] == "1"){
			$status = '<span class="badge bg-primary">Sim</span>';
		}else{
			$status = '<span class="badge bg-secondary">Não</span>';
		}

     	$action = '<a href="#" class="edit_dependente" id="'.$key['id'].'" mtype="cliente_contrato"><span class="badge bg-light-primary"><i class="far fa-file-word"></i> Editar</span></a>'; 


     $data[] = array(
       "id" => $key['id'],
       "nome" => $key['nome'],
       "cpf_dependente" => $key['cpf'],
       "dt_nascimento" => $key['nice_dt_nascimento'],
       "parentesco" => $key['nomeparentesco'],
       "dt_adesao" => $key['nice_dt_adesao'],
       "obito" => $status,
       "dt_falecimento" => $key['nice_dt_falecimento'],
       "observacao" => $key['observacao'],
       "action" => $action
     );
   }

	$data = array('data' => @$data );
	
	echo json_encode($data);

	
	die();

}








//LISTANDO DEPENDENTES
if (@$_REQUEST['action'] == "getfinanceiro"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	getfinanceiro($valores, $usuario);
}

function getfinanceiro($valores, $usuario){
	
	header('Content-Type: application/json');
	$database = new DB();


	$clientes_financeiro = "SELECT financeiro.*, 
	DATE_FORMAT(financeiro.dt_emissao,'%d/%m/%Y ') AS nice_dt_emissao,
	DATE_FORMAT(financeiro.dt_vencimento,'%d/%m/%Y ') AS nice_dt_vencimento,
	DATE_FORMAT(financeiro.dt_pagamento,'%d/%m/%Y ') AS nice_dt_pagamento,
	status_financeiro.nome AS nomestatus,
	status_financeiro.style AS statusformat
	FROM financeiro 
	LEFT JOIN status_financeiro ON status_financeiro.id = financeiro.status
	WHERE cliente='".$_GET['cliente']."' ORDER by id DESC";
	$resultados_clientes_financeiro = $database->get_results($clientes_financeiro);

	
   	foreach ($resultados_clientes_financeiro as $key ) {
     	$action = '<a href="#" class="edit_financeiro" id="'.$key['id'].'" mtype="cliente_financeiro"><span class="badge bg-light-primary"><i class="far fa-file-word"></i> Editar</span></a>'; 

		$nice_valor = number_format($key['valor'], 2, ',', ' ');
		$nice_valor_pagamento = number_format($key['valor_pagamento'], 2, ',', ' ');

		$status_label = '<span class="badge '.$key['statusformat'].'">'.$key['nomestatus'].'</span>';

     $data[] = array(
       "id" => $key['id'],
       "cliente" => $key['cliente'],
       "descricao" => $key['descricao'],
       "valor" => "R$ ".$nice_valor,
       "valor_pagamento" => "R$ ".$nice_valor_pagamento,
       "status" => $status_label,
       "dt_vencimento" => $key['nice_dt_vencimento'],
       "dt_pagamento" => $key['nice_dt_pagamento'],
       "action" => $action
     );
   }

	$data = array('data' => @$data );
	
	echo json_encode($data);

	
	die();

}




//LISTANDO DEPENDENTES
if (@$_REQUEST['action'] == "medico_excluir"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	medico_excluir($valores, $usuario);
}

function medico_excluir($valores, $usuario){
	
	$database = new DB();
		
	$idmedico = $valores['id'];

    $update = array( 'status' => '0' );
    $update_where = array( 'id' => $idmedico );
    $database->update( 'medicos', $update, $update_where, 1 );

    echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Médico excluido.</div>';
    echo '<button type="button" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Fechar</button>';
	// SALVANDO REGISTRO 
	criar_log('medico_excluir', $valores['id']);

}


function criar_log($area, $id){

	$database = new DB();

	$usuario 	= $_SESSION['fran_id'];
	$data       = date("Y-m-d G:i:s");


	$user_data = array(
		'user' => $usuario,
		'data' => $data, 
		'area'   => $area, 
		'referencia' => $id
	 );
	 $database->insert('log_atividades', $user_data );		

}





//LISTANDO DEPENDENTES
if (@$_REQUEST['action'] == "cadastrar_obito"){
	$usuario 	= $_SESSION['fran_id'];
	$valores 	= $_POST;
	cadastrar_obito($valores, $usuario);
}

function cadastrar_obito($valores, $usuario){

	$database = new DB();

	$filhos = implode(',', $valores['filhonome']);

	$datahoje = date("Y-m-d");


	//definindo o escolhido
	$checkclicado = $valores['falecido_check'];
	$falecido = explode(".", $checkclicado);

	if($falecido['1'] != "0"){
		$titularcode = "0";
		$falecidocode = $falecido['1'];
	}else{
		$titularcode = "1";
		$falecidocode = $falecido['0'];
	}


	$user_data = array(
		'cliente' 				=> $valores['id'],
		'titular' 				=> $titularcode,
		'falecido' 				=> $falecidocode,
		'data_cadastro' 		=> $datahoje,

		'numero_declaracao'		=> $valores['numero_declaracao'],
		'data_obito'			=> $valores['data_obito'],
		'local_obito'			=> addslashes($valores['local_obito']),
		'hora_obito'			=> $valores['hora_obito'],
		'hora_sepultamento'		=> $valores['hora_sepultamento'],
		'cemiterio'				=> addslashes($valores['cemiterio']),
		'cidade_cemiterio'		=> addslashes($valores['cidade_cemiterio']),
		'quadra_cemiterio'		=> $valores['quadra_cemiterio'],
		'perpetuo'				=> $valores['perpetuo'],
		'deixa_bens'			=> $valores['deixa_bens'],
		'testamento'			=> $valores['testamento'],

		'nome_declarante'		=> addslashes($valores['nome_declarante']),
		'cpf_declarante'		=> $valores['cpf_declarante'],
		'rg_declarante'			=> $valores['rg_declarante'],
		'cep_declarante'		=> $valores['cep_declarante'],
		'endereco_declarante' 	=> addslashes($valores['endereco_declarante']),
		'numero_declarante' 	=> $valores['numero_declarante'],
		'complemento_declarante'=> addslashes($valores['complemento_declarante']),
		'bairro_declarante'		=> addslashes($valores['bairro_declarante']),
		'cidade_declarante'		=> addslashes($valores['cidade_declarante']),
		'estado_declarante'		=> $valores['estado_declarante'],
		'tel_res_declarante'	=> $valores['tel_res_declarante'],
		'tel_cel_declarante'	=> $valores['tel_cel_declarante'],

		'nome_medico' 			=> addslashes($valores['nome_medico']),
		'crm_medico' 			=> $valores['crm_medico'],
		'dt_assinatura' 		=> $valores['dt_assinatura'],
		'telefone_medico'		=> $valores['telefone_medico'],
		'causa_morte' 			=> addslashes($valores['causa_morte']),
		
		'filhos' 				=> addslashes($filhos),

		'status_civil' 			=> $valores['status_civil'],
		'dt_civil' 				=> $valores['dt_civil'],
		'conjuge_civil' 		=> addslashes($valores['conjuge_civil']),
		'cartorio_civil' 		=> addslashes($valores['cartorio_civil']),
		'certidao_civil' 		=> $valores['certidao_civil'],
		'folha_civil' 			=> $valores['folha_civil'],
		'livro_civil' 			=> $valores['livro_civil']
	);



	 $database->insert('ficha_obito', $user_data );		

	criar_log('cadastrar_obito', $valores['id']);
}
