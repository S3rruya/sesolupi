<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Impressão de Carteirinha */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Impressão de Carteirinha */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();



	$query_clientes = "SELECT * FROM clientes WHERE  clientes.id = '".$_GET['id']."' LIMIT 1";
	$resultados  = $database->get_row( $query_clientes );

		$clientes_parciais = "SELECT dependentes.*, parentesco.nome AS nomeparentesco,
						DATE_FORMAT(dependentes.dt_nascimento,'%d/%m/%Y ') AS nice_dt_nascimento,
						DATE_FORMAT(dependentes.dt_adesao,'%d/%m/%Y ') AS nice_dt_adesao,
						DATE_FORMAT(dependentes.dt_falecimento,'%d/%m/%Y ') AS nice_dt_falecimento
							FROM dependentes 
						LEFT JOIN parentesco ON parentesco.id = dependentes.parentesco
						WHERE referencia='".$_GET['id']."' ORDER by id DESC";
		
		$resultados_clientes_parciais = $database->get_results($clientes_parciais);
	   	

// echo "<pre>";
// print_r($resultados_clientes_parciais);
// echo "</pre>";

$nome 		= $resultados->nome ;//( EMAIL_FRANQUEADO );
$telefone 	= $resultados->tel_cel;//( "Web4 ".NOME_UNIDADE );


$image = ImageCreateFromJPEG( PATH_UPLOAD."includes/modal_template/assinatura/bg_carterinha.jpg" );
$cor1 = imagecolorallocate( $image, 175,79,4 );
$cor2 = imagecolorallocate( $image, 255,6,5 );
$cor3 = imagecolorallocate( $image, 0,5,11 );

$font = PATH_UPLOAD.'includes/modal_template/assinatura/Roboto-Regular.ttf';
$font2 = PATH_UPLOAD.'includes/modal_template/assinatura/Roboto-Bold.ttf';

$a = imagettftextjustified($image, 20, 0, 141, 429, $cor2, $font, $nome, 385, $minspacing=3,$linespacing=1);
$b = imagettftextjustified($image, 20, 0, 526, 429, $cor2, $font, $telefone, 400, $minspacing=3,$linespacing=1);

  		$nextline ="1";
  	foreach ($resultados_clientes_parciais as $key ) {
		$espaco = 30 * $nextline;
		$beneficiario = $nextline.") ".$key['nome'];
		$c = imagettftextjustified($image, 17, 0, 1004, 30+$espaco, $cor2, $font, $beneficiario, 600, $minspacing=3,$linespacing=1);
		$nextline++;
	}

//header('Content-type: image/jpeg');
imagejpeg($image, PATH_UPLOAD.'includes/modal_template/assinatura/'.$_GET['id'].'.jpg',100);

?>


<div id="printarea<?php echo $_GET['id']; ?>">
	<img width="100%" class="img-flluid" src="<?php echo URL_UPLOAD;?>includes/modal_template/assinatura/<?php echo $_GET['id']; ?>.jpg?v=<?php echo date("Gis");?>">
</div>