<?php 


// CRIANDO OS REGISTROS FINANCEIROS
function criandocontrato($idcliente, $tipo){

	$database = new DB();
	$datahj = date("Y-m-d");
	$data_final = date("Y-m-d", strtotime("+1 year"));

	$user_data = array(
		'cliente' 		=> $idcliente,
		'tipo' 			=> $tipo,
		'contratacao'	=> $datahj,
		'renovacao'		=> $data_final
	);
	$database->insert('contrato', $user_data );		

	$last = $database->lastid();

	return $last;

}




// CRIANDO OS REGISTROS FINANCEIROS
function criarregistros($idcliente, $tipo, $diabase, $contrato){

	$database = new DB();


	$query_configuracao = "SELECT *, DATE_FORMAT(date_update, '%d/%m/%Y') as ultimaatualizacao FROM configuracao WHERE  configuracao.id = '1' LIMIT 1";
	$results_configuracao  = $database->get_row( $query_configuracao );

	$salariominimo = $results_configuracao->salariominimo;

		$datahj = date("Y-m-d");
		$mes_refer  = date("Y-m");
		$diabase = $diabase;
		

		if($tipo == "M"){

			$valor = $salariominimo / 12;

			for ($i=1; $i <= 12; $i++) {
			
				$mesesadd = $i -1;

			
		        if($diabase > "28"){
		          $vencimento = date('Y-m-d', strtotime($datahj."-".' last day of +'.$mesesadd.' month'));
		        }else{
		          $vencimento = date('Y-m-'.$diabase, strtotime($mes_refer."-".$diabase.' last day of +'.$mesesadd.' month'));
		        }

		        //data entrada
		        if($i=="1"){$vencimento = $datahj;}

				$user_data = array(
					'contrato' 		=> $contrato,
					'cliente' 		=> $idcliente,
					'valor' 		=> $valor,
					'status' 		=> '1', 
					'dt_emissao'	=> $datahj,
					'dt_vencimento'	=> $vencimento
				);
				$database->insert('financeiro', $user_data );	
		    }
		}
		elseif($tipo == "A"){

			$valor = $salariominimo / 4;

			for ($i=1; $i <= 4; $i++) {			

				$mesesadd = $i -1;

		        if($diabase > "28"){
		          $vencimento = date('Y-m-d', strtotime($datahj."-".' last day of +'.$mesesadd.' month'));
		        }else{
		          $vencimento = date('Y-m-'.$diabase, strtotime($mes_refer."-".$diabase.' last day of +'.$mesesadd.' month'));
		        }

		        //data entrada
		        if($i=="1"){$vencimento = $datahj;}

				$user_data = array(
					'contrato' 		=> $contrato,					
					'cliente' 		=> $idcliente,
					'valor' 		=> $valor,
					'status' 		=> '1',
					'dt_emissao'	=> $datahj,
					'dt_vencimento'	=> $vencimento
				);
				$database->insert('financeiro', $user_data );	
		    }			
		}
	//return $resultados_status;
}







function imagettftextjustified(&$image, $size, $angle, $left, $top, $color, $font, $text, $max_width, $minspacing=3,$linespacing=1){
	$wordwidth = array();
	$linewidth = array();
	$linewordcount = array();
	$largest_line_height = 0;
	$lineno=0;

	$words=explode(" ",$text);
	$wln=0;
	$linewidth[$lineno]=0;
	$linewordcount[$lineno]=0;
	foreach ($words as $word){
		$dimensions = imagettfbbox($size, $angle, $font, $word);
		$line_width = $dimensions[2] - $dimensions[0];
		$line_height = $dimensions[1] - $dimensions[7];
	
		if ($line_height>$largest_line_height) $largest_line_height=$line_height;
		if (($linewidth[$lineno]+$line_width+$minspacing)>$max_width){
			$lineno++;
			$linewidth[$lineno]=0;
			$linewordcount[$lineno]=0;
			$wln=0;
		}
		$linewidth[$lineno]+=$line_width+$minspacing;
		$wordwidth[$lineno][$wln]=$line_width;
		$wordtext[$lineno][$wln]=$word;
		$linewordcount[$lineno]++;
		$wln++;
	}
	for ($ln=0;$ln<=$lineno;$ln++)	{
		$slack=$max_width-$linewidth[$ln];
		if (($linewordcount[$ln]>1)&&($ln!=$lineno)) $spacing=($slack/($linewordcount[$ln]-1));
		else $spacing=$minspacing;
		$x=0;
	
		for ($w=0;$w<$linewordcount[$ln];$w++)	{
			imagettftext($image, $size, $angle, $left + intval($x), $top + $largest_line_height + ($largest_line_height * $ln * $linespacing), $color, $font, $wordtext[$ln][$w]);
			$x+=$wordwidth[$ln][$w]+$spacing+$minspacing;
		}
	}
	return true;
}          
 