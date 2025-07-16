<?php
@session_start();


$hostname = $_SERVER['HTTP_HOST'];

if($hostname == "localhost"){
	include('configs/localhost.php');
}
elseif($hostname == "oiweb4.com"){
	include('configs/stagins.php');
}else{
	include('configs/production.php');
}

//die();



date_default_timezone_set('America/Sao_Paulo');