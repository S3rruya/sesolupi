<?php
function checkfileperm($arq,$linha) {
	$arquivo = @file($arq);
 	$y = $linha+1;
 	$x = $arquivo[$y];
 	$int = (int) filter_var($x, FILTER_SANITIZE_NUMBER_INT);
 	return $int;
}


function gettitulomodal($arq,$linha) {
	$arquivo = @file($arq);
 	$y = $linha+1;
 	$x = $arquivo[$y];

 	$stringCorrigida = str_replace('/*', '', $x);
 	$stringCorrigida = str_replace('Título: ', '', $stringCorrigida);
 	$stringCorrigida = str_replace('*/', '', $stringCorrigida);
 //	$int = (int) filter_var($x, FILTER_SANITIZE_NUMBER_INT);
 	return $stringCorrigida;
}