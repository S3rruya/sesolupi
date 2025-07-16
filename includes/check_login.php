<?php
@session_start();

if(!(@$_SESSION['fran_id'] )) {
	header('Location: ../index.php?error=2');

	die();
}

define('IDUSER', 			$_SESSION['fran_id']);
define('LEVELACCESS',		$_SESSION['fran_levelaccess']);
define('NOME_FUNCIONARIO', 	$_SESSION['fran_nome']);
define('EMAIL_FUNCIONARIO', $_SESSION['fran_email']);


$link_check = @array_filter(explode("/", $_GET['pasta']));
if(@$link_check['1']=="confirmar_saida"){	

	$domain = $_SERVER['HTTP_HOST'];
	setcookie('emailusuario', '', time()-60*60*24*365, '/', $domain, false);
}


