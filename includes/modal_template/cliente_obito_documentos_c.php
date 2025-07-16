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



?>
<!--html-->

<a href="#" class="open_modal" id="<?php echo $results_fichas->cliente;?>" mtype="cliente_obito_documentos" >Voltar</a>

<div id="printarea<?php echo $_GET['id'];?>">
	<div class="contratologo"></div>
	<div class="contratobody">
		<h5 class="text-center"><b>TERMO DE RESPONSABILIDADE</b></h5>

		<p class="text-right"><b>No. Óbito: <?php echo $results_fichas->numero_declaracao;?></b></p>		

		<div class="container">
			<div class="row g-2 mb-2">
				<div class="col-12">
					<p>A FUNERÁRIA SESOLUPI se responsabiliza a entregar a guia de sepultamento junto ao administrador do <?php echo $results_fichas->cemiterio;?> no prazo de 48 horas a conta desta data.</p>
					<p>&nbsp;</p>
					<p>Nome do Falecido: <?php echo $falecido->nome;?></p>
					<p>Data de falecimento: <?php echo $results_fichas->nice_data_obito;?></p>
					<p>Hora do Sepultamento: <?php echo $results_fichas->hora_sepultamento;?></p>
				</div>
			</div>
			<div class="row g-2 mb-2">

				<div class="col-12 text-center">
					<br><br>
					_______________________________<br>
					Funária Sesolupi
				</div>
			</div>

			<div class="row m-5">
				<div class="col-12 linha">
		    		<i class="fas fa-cut"></i>
				</div>
			</div>


			<div class="row g-2 mb-2">
				<div class="col-12">
					<p>A</p>
					<p>FUNERÁRIA SESOLUPI</p>

					<p class="text-right"><b>No. Óbito: <?php echo $results_fichas->numero_declaracao;?></b></p>		

					<p>A Administração do <?php echo $results_fichas->cemiterio;?> declara ter recebido a TAXA DE SEPULTAMENTO de:</p>
					<br><br>

					<p>Nome do Falecido: <?php echo $falecido->nome;?></p>
					<p>Data Falecimento: <?php echo $results_fichas->nice_data_obito;?></p>
					<p>Quadra Nº: <?php echo $results_fichas->quadra_cemiterio;?></p>
					<p>Talão Nº: ___________________________________________________<?php //echo $results_fichas->nice_data_obito;?></p>

					<p>Valor da Taxa – R$ ________ (__________________________________________________)</p>
				</div>
			</div>
			<div class="row g-2 mb-2">
				<div class="col-2">
					<p>Ala Geral</p>
				</div>
				<div class="col-2">
					<div class="boxrecibo"></div>
				</div>
				<div class="col-2">
					<p>Perpétuo</p>
				</div>
				<div class="col-2">
					<div class="boxrecibo text-center">
						<?php 
						if($results_fichas->perpetuo == "s"){
							echo "X";
						}
						?>
					</div>
				</div>
				<div class="col-12">
					<br><br>
					<p class="text-right">___________________________</p>
					<p class="text-right">Responsável pelo Recibo</p>
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
  	font-size: 85%;
    display: inline-block;
    top: -10px;
    position: inherit;
    left: -10px;
  }

  .linha{
  	position: relative;
  	border-bottom: 1px dotted black;
  }
  .linha i{
  	position: absolute;
  	top: -8px;
  	left: -10px;
  }

  .boxrecibo{
  	width: 30px;
  	height: 30px;
  	line-height: 30px;
  	border: 1px solid black;
  }

</style>