<?php

@session_start();
//verificação de login

include_once("classes/config.php");
include_once("classes/database.php");
include_once("classes/send_mensages.php");
if ($_POST['acao'] == "login"){

 $database = new DB();


$query = "SELECT 
			usuarios.*
		FROM usuarios
        WHERE usuarios.login='".addslashes($_POST['login_c'])."' AND
        usuarios.senha='".addslashes($_POST['senha_c'])."' AND
        usuarios.status='1'
        LIMIT 1";
    
// echo $query;
// die();

if( $database->num_rows( $query ) > 0 ){
	$results = $database->get_row( $query );

		$_SESSION['fran_id']      		= $results->id;
		$_SESSION['fran_levelaccess'] 	= $results->nivel;
		$_SESSION['fran_email']   		= $results->email;
		$_SESSION['fran_nome']    		= $results->nome;

		//configurando cookie
		setcookie('emailusuario', $results->login, time()+60*60*24*365, '/', DOMAIN, false);

		$paraquem = "elizeulima@web4comunicacao.com";
		$nomerecebedor = "Web4 Comunicacao";
		$assuntodamensagem = "Acesso permitido";
		$dequememail = "central@web4comunicacao.com";
		$dequemnome = "Sistema SESOLUPI";


		$pegar_ip = $_SERVER["REMOTE_ADDR"];

		$dadosmsg = array('unidade' => $results->fran_cidade, 'login' => $results->login, 'ip' => $pegar_ip, 'dispositivo' => $_COOKIE['dispositivo']);

		enviaremail($paraquem, $nomerecebedor, $assuntodamensagem, $dequememail, $dequemnome, $mensagem='acesso-permitido', $dadosmsg);

		header("Location: controle/"); //Redireciono para a página principal
		exit;
	}else{
		setcookie('emailusuario', null, time()-60*60*24*365, '/', DOMAIN, false);

		$paraquem = "elizeulima@web4comunicacao.com";
		$nomerecebedor = "Web4 Comunicacao";
		$assuntodamensagem = "Acesso negado";
		$dequememail = "central@web4comunicacao.com";
		$dequemnome = "Sistema SESOLUPI";

		$pegar_ip = $_SERVER["REMOTE_ADDR"];
		
		$dadosmsg = array('login' => $_POST['login_c'], 'senha' => $_POST['senha_c'], 'ip' => $pegar_ip, 'dispositivo' => $_COOKIE['dispositivo']);

		enviaremail($paraquem, $nomerecebedor, $assuntodamensagem, $dequememail, $dequemnome, $mensagem='acesso-negado', $dadosmsg);

   		header("Location: index.php?error=1"); //Redireciono para a página principal
    exit;
	}
}


  