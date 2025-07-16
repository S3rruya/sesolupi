<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Documentos de Óbito */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Documentos de Óbito */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();



	$query_fichas = "SELECT *,
	DATE_FORMAT(ficha_obito.data_obito,'%d/%m/%Y ') AS nice_data_obito
	 FROM ficha_obito WHERE  ficha_obito.id = '".$_GET['id']."' ";
	$results_fichas  = $database->get_row( $query_fichas );


    if($results_fichas->titular != "0"){
        $query_falecido = "SELECT clientes.*, 
        status_civil.nome AS status_civilnome
         FROM clientes 
        	LEFT JOIN status_civil ON status_civil.id = clientes.estado_civil
        WHERE  clientes.id = '".$results_fichas->titular."' LIMIT 1";
        $falecido  = $database->get_row( $query_falecido );
    }else{
        $query_falecido = "SELECT dependentes.* FROM dependentes WHERE  dependentes.id = '".$results_fichas->falecido."' LIMIT 1";
        $falecido  = $database->get_row( $query_falecido );
    }

$dataNascimento = $falecido->data_nascimento;
$data_hj = new DateTime($dataNascimento );
$idade = $data_hj->diff( new DateTime( date('Y-m-d') ) );

// echo "<pre>";
// print_r($results_fichas);
// echo "</pre>";
?>
<!--html-->

<a href="#" class="open_modal" id="<?php echo $results_fichas->cliente;?>" mtype="cliente_obito_documentos" >Voltar</a>
<div id="printarea<?php echo $_GET['id'];?>">
	<div class="contratologo"></div>
	<div class="contratobody">
		<h5 class="text-center"><b>DECLARAÇÃO DE ÓBITO</b></h5>
		<h6 class="text-center"><b><?php echo $falecido->nome;?></b></h6>		
		<div class="container">
			<div class="row g-2 mb-2">
				<div class="col-2">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Idade</span>
						<?php echo $idade->format( '%Y anos' );?>
					</div>
				</div>
				<div class="col-2">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Sexo</span>
						<?php echo $falecido->sexo;?>
					</div>
				</div>
				<div class="col-2">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Cor</span>
						<?php echo $falecido->cor;?>
					</div>
				</div>
				<div class="col-3">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Natural</span>
						<?php echo $falecido->naturalidade;?>
					</div>
				</div>
				<div class="col-3">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Nacionalidade</span>
						-<?php //echo $falecido->naturalidade;?>
					</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-2">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Estado Civil</span>
						<?php echo $falecido->status_civilnome;?>
					</div>
				</div>
				<div class="col-4">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Título de eleitor</span>
					-<?php //echo $falecido->nome;?>
				</div>
				</div>
				<div class="col-6">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Documentos</span>
					CPF: <?php echo $falecido->cpf;?> / RG.: <?php echo $falecido->rg;?>
				</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Endereço</span>
					<?php echo $falecido->endereco;?>, <?php echo $falecido->numero ;?> - <?php echo $falecido->complemento;?> - <?php echo $falecido->bairro;?> <br><?php echo $falecido->cidade;?>/<?php echo $falecido->estado;?> - CEP.: <?php echo $falecido->cep;?>
				</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Profissão</span>
					<?php echo $falecido->profissao;?>
				</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Filiação</span>
						<div class="row">
							<div class="col-6">-<?php //echo $falecido->nome;?></div>
							<div class="col-6">-<?php //echo $falecido->nome;?></div>
						</div>
					</div>
				</div>
			</div>		
			<div class="row g-2 mb-2">
				<div class="col-3">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Certidão</span>
					<?php echo $results_fichas->numero_declaracao;?>
				</div>
				</div>

				<div class="col-9">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Local, data e horário do falecimento</span>
					<?php echo $results_fichas->local_obito;?> no dia <?php echo $results_fichas->nice_data_obito;?> às <?php echo $results_fichas->hora_obito;?>
				</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Local de sepultamento</span>
					Cemitério: <?php echo $results_fichas->cemiterio;?> na Cidade: <?php echo $results_fichas->cidade_cemiterio;?> - Quadra: <?php echo $results_fichas->cemiterio;?>
				</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-9">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Nome completo (cônjuge)</span>
						<?php echo $results_fichas->conjuge_civil;?> 
					</div>
				</div>
				<div class="col-3">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Data união</span>
						<?php echo $results_fichas->dt_civil;?>
					</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Cidade da união</span>
						<?php echo $results_fichas->cartorio_civil;?> [Certidão: <?php echo $results_fichas->certidao_civil;?> Folha: <?php echo $results_fichas->folha_civil;?> Livro: <?php echo $results_fichas->livro_civil;?>]
					</div>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Filhos</span>
					-<br>
					-<br>
					-<br>
					<?php echo $results_fichas->filhos;?>
				</div>
				</div>
			</div>
			<div class="row g-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Bens e testamentos</span>
					Deixa bens: <?php echo $results_fichas->deixa_bens;?> | Testamento: <?php echo $results_fichas->testamento;?>
				</div>
				</div>
			</div>
			<div class="row g-2">
				<div class="col-12">
					<div class="p-3 prelative text-center"><p>Reli a presente declaração e estando de acordo com os dados nela inseridos, responsabilizo-me por futuras contestações.</p></div>
				</div>

				<div class="col-12 text-center">
					<br>
					_______________________________<br>
					Assinatura do Declarante
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-12">
					<div class="pt-3 pb-2 px-2 border bg-light prelative"><span class="nomecampo">Declarante</span>
					<?php echo $results_fichas->nome_declarante;?><br>
					<?php echo $results_fichas->endereco_declarante;?>, <?php echo $results_fichas->numero_declarante;?> - <?php echo $results_fichas->complemento_declarante;?> - <?php echo $results_fichas->bairro_declarante;?> <br> <?php echo $results_fichas->cidade_declarante;?>/<?php echo $results_fichas->estado_declarante;?> - CEP.: <?php echo $results_fichas->cep_declarante;?> | CPF.: <?php echo $results_fichas->cpf_declarante;?> | RG.:<?php echo $results_fichas->rg_declarante;?>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
  .contratologo{
    background-image: url("<?php echo URL_UPLOAD;?>/assets/images/logo/logo.png");
    background-position: top center;
    background-repeat: no-repeat;
    background-size: 80px;
    height: 80px;
  }
  .contratobody {
    line-height: 1.20;
    
  }
  .contratobody p{
    margin: 4px 0 4px 0px;
  }
	
  .boxline{
  	border: 1px solid black;
  }
  .prelative{
  	position: relative;
  }
  .nomecampo{
  	font-size: 80%;
    display: inline-block;
    top: 2px;
    position: absolute;
    left: 8px;
  }
</style>