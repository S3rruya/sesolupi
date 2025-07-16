<?php

require_once(PATH_UPLOAD."classes/phpmailer/class.phpmailer.php");
require_once(PATH_UPLOAD."classes/phpmailer/class.smtp.php");

function enviaremail($paraquem, $nomerecebedor, $assuntodamensagem, $dequememail, $dequemnome, $mensagem, $referencia){
  $mail = new PHPMailer;
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 2;
  $mail = new PHPMailer();
  $mail->IsSMTP(); // Define que a mensagem será SMTP
  $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
  $mail->Port = 587;
  $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
  $mail->Host = 'smtp.web4comunicacao.com.br';	// SMTP utilizado
  $mail->Username = 'naoresponder@web4comunicacao.com.br'; // Usuário do servidor SMTP (endereço de email)
  $mail->Password = 'uvMqM5??Tnn4'; // Senha do servidor SMTP (senha do email usado)
  $mail->Sender = "atendimento@web4comunicacao.com"; // Seu e-mail
  $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
  $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

	$mail->From = $dequememail;
	$mail->FromName = $dequemnome;
	$mail->AddAddress($paraquem, $nomerecebedor);
	
	$mail->AddBCC('atendimento@web4comunicacao.com'); // Cópia Oculta
	$mail->Subject  = "$assuntodamensagem"; // Assunto da mensagem

	$body_html = montarmsg($mensagem, $referencia);

	$mail->Body = $body_html;

	$mail->AltBody = 'Mensagem em HTML, e seu serviço de e-mail não é compatível.\r\n  ';
	//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo

	$enviado = $mail->Send();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

}

function montarmsg($mensagem, $referencia){
  //TEMPLATE DE EMAIL
	$filename = PATH_UPLOAD."includes/templates_emails/".$mensagem.".html";
	$handle = fopen ($filename,"r");
	$msg_clie = fread ($handle, filesize ($filename));

	

	$msg_clie 	= preg_replace("/\[url_img\]/", URL_UPLOAD, $msg_clie);

	$database = new DB();


  	if($mensagem == "acesso-permitido"){

  		$msg_clie   = preg_replace("/\[unidade\]/", $referencia['unidade'], $msg_clie);
  		$msg_clie   = preg_replace("/\[login\]/", $referencia['login'], $msg_clie);
  		$msg_clie   = preg_replace("/\[ip\]/", $referencia['ip'], $msg_clie);
  		$msg_clie   = preg_replace("/\[dispositivo\]/", $referencia['dispositivo'], $msg_clie);
  	}

  	elseif($mensagem == "acesso-negado"){
  		
  		$msg_clie   = preg_replace("/\[login\]/", $referencia['login'], $msg_clie);
  		$msg_clie   = preg_replace("/\[senha\]/", $referencia['senha'], $msg_clie);
  		$msg_clie   = preg_replace("/\[ip\]/", $referencia['ip'], $msg_clie);
  		$msg_clie   = preg_replace("/\[dispositivo\]/", $referencia['dispositivo'], $msg_clie);

  	}
  	//alerta de cron
  	elseif($mensagem == "cron"){
  		$msg_clie   = preg_replace("/\[ip\]/", $referencia['ip'], $msg_clie);
  	}

  	elseif($mensagem == "retorno"){
  		$msg_clie   = preg_replace("/\[fatura\]/", $referencia['fatura'], $msg_clie);
  		$msg_clie   = preg_replace("/\[transaction\]/", $referencia['transaction'], $msg_clie);
  		$msg_clie   = preg_replace("/\[notification\]/", $referencia['notification'], $msg_clie);
  	}




	elseif($mensagem == "orcamento-novo"){

		$query_dados = "SELECT DLM9Igtjz_novosys_briefing.*, 
							DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
							DLM9Igtjz_novosys_franqueado_usuarios.nome AS nome_usuario
							FROM  DLM9Igtjz_novosys_briefing 
							LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_briefing.unidade
							LEFT JOIN DLM9Igtjz_novosys_franqueado_usuarios ON DLM9Igtjz_novosys_franqueado_usuarios.id=DLM9Igtjz_novosys_briefing.colaborador
							WHERE DLM9Igtjz_novosys_briefing.id='".$referencia['id_bd']."' LIMIT 1";
		$results_dados  = $database->get_row( $query_dados );



		$msg_clie   = preg_replace("/\[nome_unidade\]/", $results_dados->nome_unidade, $msg_clie);
		$msg_clie   = preg_replace("/\[codigoorcamento\]/", $referencia['id_bd'], $msg_clie);
		$msg_clie   = preg_replace("/\[usuario\]/", $results_dados->nome_usuario, $msg_clie);

  	}

  	elseif($mensagem == "libera-job"){

		$queryfatura    = "SELECT 
		DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
		DLM9Igtjz_novosys_faturas.numerojob, DLM9Igtjz_novosys_faturas.status 
		FROM DLM9Igtjz_novosys_faturas 
		LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_faturas.franqueado 
		WHERE DLM9Igtjz_novosys_faturas.id='".$referencia."' limit 1 ";
		$results_faturas  = $database->get_row( $queryfatura );

  		$msg_clie   = preg_replace("/\[fatura\]/", $referencia, $msg_clie);
  		$msg_clie   = preg_replace("/\[job\]/", $results_faturas->numerojob, $msg_clie);
  		$msg_clie   = preg_replace("/\[unidade\]/", $results_faturas->nome_unidade, $msg_clie);
  		
  	}
  	

  	elseif($mensagem == "orcamento-feedback"){

		$queryfatura    = "SELECT DLM9Igtjz_novosys_briefing.*,
		DLM9Igtjz_novosys_status_briefing.nome AS nome_status,
		DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
		DLM9Igtjz_novosys_franqueado_usuarios.nome AS nome_usuario
		FROM DLM9Igtjz_novosys_briefing
		LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_briefing.unidade 
		LEFT JOIN DLM9Igtjz_novosys_status_briefing ON DLM9Igtjz_novosys_status_briefing.id=DLM9Igtjz_novosys_briefing.feedback
		LEFT JOIN DLM9Igtjz_novosys_franqueado_usuarios ON DLM9Igtjz_novosys_franqueado_usuarios.id=DLM9Igtjz_novosys_briefing.colaborador
		WHERE DLM9Igtjz_novosys_briefing.id='".$referencia['idfeedback']."' limit 1 ";
		$results_faturas  = $database->get_row( $queryfatura );

  		$msg_clie   = preg_replace("/\[usuario\]/", $results_faturas->nome_usuario, $msg_clie);
  		$msg_clie   = preg_replace("/\[unidade\]/", $results_faturas->nome_unidade, $msg_clie);
  		$msg_clie   = preg_replace("/\[idfeedback\]/", $results_faturas->id, $msg_clie);
  		$msg_clie   = preg_replace("/\[feedback\]/", $results_faturas->nome_status, $msg_clie);
  		$msg_clie   = preg_replace("/\[feedback_notes\]/", $results_faturas->feedback_notes, $msg_clie);
  		$msg_clie   = preg_replace("/\[feedback_data\]/", $results_faturas->feedback_data, $msg_clie);
  		$msg_clie   = preg_replace("/\[ip\]/", $referencia['ip'], $msg_clie);
  		
  	}
  	

	elseif($mensagem == "chamado-novo"){


		$querychamado = "SELECT DLM9Igtjz_novosys_chamados.titulo,
			DLM9Igtjz_novosys_cliente.cli_nome AS nomecliente,
			DLM9Igtjz_novosys_cliente.cli_empresa AS nomeempresa,
		  	DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
			DLM9Igtjz_novosys_franqueado_usuarios.nome AS nome_usuario,
			DATE_FORMAT(DLM9Igtjz_novosys_chamados.data,'%d/%m/%Y') AS dtabertura
			 FROM  DLM9Igtjz_novosys_chamados
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado_usuarios ON DLM9Igtjz_novosys_franqueado_usuarios.id=DLM9Igtjz_novosys_chamados.usuario
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_chamados.franqueado
			LEFT JOIN DLM9Igtjz_novosys_cliente ON DLM9Igtjz_novosys_cliente.cli_id=DLM9Igtjz_novosys_chamados.cliente
			WHERE DLM9Igtjz_novosys_chamados.id='$referencia' LIMIT 1";

		$results_faturas  = $database->get_row( $querychamado );

			$msg_clie 	= preg_replace("/\[numero_chamado\]/", 	$referencia, $msg_clie);
			$msg_clie 	= preg_replace("/\[colaborador\]/",		$results_faturas->nome_usuario, $msg_clie);
			$msg_clie 	= preg_replace("/\[nome_unidade\]/",	$results_faturas->nome_unidade, $msg_clie);
			$msg_clie 	= preg_replace("/\[titulo\]/", 			$results_faturas->titulo, $msg_clie);
			$msg_clie 	= preg_replace("/\[empresa\]/", 		$results_faturas->nomeempresa, $msg_clie);
			$msg_clie 	= preg_replace("/\[cliente\]/", 		$results_faturas->nomecliente, $msg_clie);
  	}



	elseif($mensagem == "chamado-interacao"){

		$querychamado = "SELECT DLM9Igtjz_novosys_chamados.id, DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade
			 FROM  DLM9Igtjz_novosys_chamados
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_chamados.franqueado
			WHERE DLM9Igtjz_novosys_chamados.id='$referencia' LIMIT 1";

		$results_faturas  = $database->get_row( $querychamado );

			$msg_clie 	= preg_replace("/\[numero_chamado\]/", 	$referencia, $msg_clie);
			$msg_clie 	= preg_replace("/\[nome_unidade\]/", 	$results_faturas->nome_unidade, $msg_clie);

  	}


	elseif($mensagem == "job-interacao"){

		$query_job = "SELECT 
				DLM9Igtjz_novosys_jobs.tk_id, 
				DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade
			 FROM  DLM9Igtjz_novosys_jobs
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_jobs.tk_franqueado
			WHERE DLM9Igtjz_novosys_jobs.tk_id='$referencia' LIMIT 1";

		$results_faturas  = $database->get_row( $query_job );

			$msg_clie 	= preg_replace("/\[nome_unidade\]/", $results_faturas->nome_unidade, $msg_clie);
			$msg_clie 	= preg_replace("/\[numero_job\]/", 	 $referencia, $msg_clie);

  	}

	elseif($mensagem == "job-novo"){

		$query_job = "SELECT DLM9Igtjz_novosys_jobs.tk_id, DLM9Igtjz_novosys_jobs.tk_titulo,
			DLM9Igtjz_novosys_cliente.cli_nome AS nomecliente,
			DLM9Igtjz_novosys_cliente.cli_empresa AS nomeempresa,
			DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade
			 FROM  DLM9Igtjz_novosys_jobs
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_jobs.tk_franqueado
		  	LEFT JOIN DLM9Igtjz_novosys_status ON DLM9Igtjz_novosys_status.id=DLM9Igtjz_novosys_jobs.tk_status
			LEFT JOIN DLM9Igtjz_novosys_cliente ON DLM9Igtjz_novosys_cliente.cli_id=DLM9Igtjz_novosys_jobs.tk_cliente
			WHERE DLM9Igtjz_novosys_jobs.tk_id='$referencia' LIMIT 1";


		$results_faturas  = $database->get_row( $query_job );

		$msg_clie 	= preg_replace("/\[nome_unidade\]/",$results_faturas->nome_unidade, $msg_clie);
		$msg_clie 	= preg_replace("/\[numero_job\]/", 	$results_faturas->tk_id, $msg_clie);
		$msg_clie 	= preg_replace("/\[tipojob\]/", 	$results_faturas->tk_titulo, $msg_clie);
		$msg_clie 	= preg_replace("/\[empresa\]/", 	$results_faturas->nomeempresa, $msg_clie);
		$msg_clie 	= preg_replace("/\[cliente\]/", 	$results_faturas->nomecliente, $msg_clie);
		

  	}

	elseif($mensagem == "orcamento-envio-proposta"){

		$query_job = "SELECT 
				DLM9Igtjz_novosys_orcamento.id AS id_orcamento, 
				DLM9Igtjz_novosys_orcamento.unidade AS id_unidade,
				DLM9Igtjz_novosys_franqueado_usuarios.nome AS nome_colaborador,
				DLM9Igtjz_novosys_franqueado_usuarios.telefone,
				DLM9Igtjz_novosys_franqueado_usuarios.whatsapp,
				DLM9Igtjz_novosys_franqueado_usuarios.login AS email_colaborador,

				DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
				DLM9Igtjz_novosys_cliente.cli_nome AS nome_cliente, DLM9Igtjz_novosys_cliente.cli_empresa AS nome_empresa
			 FROM  DLM9Igtjz_novosys_orcamento
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_orcamento.unidade
		  	LEFT JOIN DLM9Igtjz_novosys_briefing ON DLM9Igtjz_novosys_briefing.id=DLM9Igtjz_novosys_orcamento.briefing
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado_usuarios ON DLM9Igtjz_novosys_franqueado_usuarios.id=DLM9Igtjz_novosys_orcamento.unidade
			LEFT JOIN DLM9Igtjz_novosys_cliente ON DLM9Igtjz_novosys_cliente.cli_id=DLM9Igtjz_novosys_orcamento.cliente
			WHERE DLM9Igtjz_novosys_orcamento.id='$referencia' LIMIT 1";


		$results_orcamento  = $database->get_row( $query_job );

		$msg_clie 	= preg_replace("/\[nome_cliente\]/",	$results_orcamento->nome_cliente, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_empresa\]/", 	$results_orcamento->nome_empresa, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_unidade\]/", 	$results_orcamento->nome_unidade, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_colaborador\]/",$results_orcamento->nome_colaborador, $msg_clie);		
		
		$msg_clie 	= preg_replace("/\[telefone\]/", 		$results_orcamento->telefone, $msg_clie);
		$msg_clie 	= preg_replace("/\[whatsapp\]/", 		$results_orcamento->whatsapp, $msg_clie);
		$msg_clie 	= preg_replace("/\[email\]/", 			$results_orcamento->email_colaborador, $msg_clie);

		$link_proposta = URL_UPLOAD."proposta/?p=".base64_encode($results_orcamento->id_orcamento)."&u=".base64_encode($results_orcamento->id_unidade);

		$msg_clie 	= preg_replace("/\[link_proposta\]/", 	$link_proposta, $msg_clie);


  	}
  	elseif($mensagem == "financeiro-nova-fatura"){
  		
  		$mes_fatura = date("m/Y");


		$query_job = "SELECT
		 DATE_FORMAT(DLM9Igtjz_novosys_recorrente_faturas.vencimento,'%d/%m/%Y') AS novovencimento,
		 DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade
		 FROM DLM9Igtjz_novosys_recorrente_faturas 
		LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_recorrente_faturas.franqueado
		 WHERE DLM9Igtjz_novosys_recorrente_faturas.id= '$referencia'";


		$dadosfatura  = $database->get_row( $query_job );

  		
  		$msg_clie 	= preg_replace("/\[mes_fatura\]/", 			$mes_fatura, $msg_clie);
  		$msg_clie 	= preg_replace("/\[vencimento\]/", 			$dadosfatura->novovencimento, $msg_clie);
  		$msg_clie 	= preg_replace("/\[nome_unidade\]/", 		$dadosfatura->nome_unidade, $msg_clie);

  	}


  	elseif($mensagem == "financeiro-cliente-final"){

		$query_job = "SELECT 
		DATE_FORMAT(DLM9Igtjz_novosys_recorrente_faturas.vencimento,'%d/%m/%Y') AS novovencimento, 
		DLM9Igtjz_novosys_recorrente_faturas.id_cobranca
		FROM DLM9Igtjz_novosys_recorrente_faturas 
		WHERE DLM9Igtjz_novosys_recorrente_faturas.id= '$referencia'";

		$dadosfatura  = $database->get_row( $query_job );

		$segundaconsulta = "SELECT 
		DLM9Igtjz_novosys_cliente.cli_nome,
		DLM9Igtjz_novosys_faturas.linkboleto
		FROM DLM9Igtjz_novosys_faturas
		LEFT JOIN DLM9Igtjz_novosys_cliente ON DLM9Igtjz_novosys_cliente.cli_id=DLM9Igtjz_novosys_faturas.cliente
		WHERE DLM9Igtjz_novosys_faturas.id= '".$dadosfatura->id_cobranca."'";

		$segundosdados  = $database->get_row( $segundaconsulta );

  		$msg_clie 	= preg_replace("/\[vencimento\]/", 			$dadosfatura->novovencimento, $msg_clie);
  		$msg_clie 	= preg_replace("/\[nome_contato\]/", 		$segundosdados->cli_nome, $msg_clie);
  		$msg_clie 	= preg_replace("/\[link_widepay\]/", 		$segundosdados->linkboleto, $msg_clie);

  	}  	

  	//cadastro
  	elseif($mensagem == "atualizacao_dados"){

//print_r($referencia);
  		$msg_clie   = preg_replace("/\[unidade\]/", $referencia['unidade'], $msg_clie);
  		$msg_clie   = preg_replace("/\[endereco\]/", $referencia['dados']['0']['endereco'], $msg_clie);
  		$msg_clie   = preg_replace("/\[numero\]/", $referencia['dados']['0']['numero'], $msg_clie);
  		$msg_clie   = preg_replace("/\[complemento\]/", $referencia['dados']['0']['complemento'], $msg_clie);
  		$msg_clie   = preg_replace("/\[bairro\]/", $referencia['dados']['0']['bairro'], $msg_clie);
  		$msg_clie   = preg_replace("/\[cidade\]/", $referencia['dados']['0']['cidade'], $msg_clie);
  		$msg_clie   = preg_replace("/\[estado\]/", $referencia['dados']['0']['estado'], $msg_clie);
  		$msg_clie   = preg_replace("/\[cep\]/", $referencia['dados']['0']['cep'], $msg_clie);
  		$msg_clie   = preg_replace("/\[cnpj\]/", $referencia['dados']['0']['cnpj'], $msg_clie);
  		$msg_clie   = preg_replace("/\[contato_telefone1\]/", $referencia['dados']['0']['contato_telefone1'], $msg_clie);
  		$msg_clie   = preg_replace("/\[contato_telefone2\]/", $referencia['dados']['0']['contato_telefone2'], $msg_clie);
  		$msg_clie   = preg_replace("/\[contato_telefone3\]/", $referencia['dados']['0']['contato_telefone3'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante1_nome\]/", $referencia['dados']['0']['representante1_nome'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante1_email\]/", $referencia['dados']['0']['representante1_email'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante1_nascimento\]/", $referencia['dados']['0']['representante1_nascimento'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante2_nome\]/", $referencia['dados']['0']['representante2_nome'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante2_email\]/", $referencia['dados']['0']['representante2_email'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante2_nascimento\]/", $referencia['dados']['0']['representante2_nascimento'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante3_nome\]/", $referencia['dados']['0']['representante3_nome'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante3_email\]/", $referencia['dados']['0']['representante3_email'], $msg_clie);
  		$msg_clie   = preg_replace("/\[representante3_nascimento\]/", $referencia['dados']['0']['representante3_nascimento'], $msg_clie);
  	  	$msg_clie   = preg_replace("/\[descricao\]/", $referencia['dados']['0']['descricao'], $msg_clie);


  	}


  	//alerta de cron
  	elseif($mensagem == "logomaker"){
  		
		$query_job = "SELECT 
				DLM9Igtjz_novosys_digital_briefing.id AS id_logomaker, 
				DLM9Igtjz_novosys_digital_briefing.unidade AS id_unidade,
				DLM9Igtjz_novosys_franqueado_usuarios.nome AS nome_colaborador,
				DLM9Igtjz_novosys_franqueado_usuarios.telefone,
				DLM9Igtjz_novosys_franqueado_usuarios.whatsapp,
				DLM9Igtjz_novosys_franqueado_usuarios.login AS email_colaborador,

				DLM9Igtjz_novosys_franqueado.fran_cidade AS nome_unidade,
				DLM9Igtjz_novosys_cliente.cli_nome AS nome_cliente, DLM9Igtjz_novosys_cliente.cli_empresa AS nome_empresa

			 FROM  DLM9Igtjz_novosys_digital_briefing

		  	LEFT JOIN DLM9Igtjz_novosys_franqueado ON DLM9Igtjz_novosys_franqueado.fran_id=DLM9Igtjz_novosys_digital_briefing.unidade
		  	LEFT JOIN DLM9Igtjz_novosys_franqueado_usuarios ON DLM9Igtjz_novosys_franqueado_usuarios.id=DLM9Igtjz_novosys_digital_briefing.colaborador
			LEFT JOIN DLM9Igtjz_novosys_cliente ON DLM9Igtjz_novosys_cliente.cli_id=DLM9Igtjz_novosys_digital_briefing.cliente

			WHERE DLM9Igtjz_novosys_digital_briefing.id='$referencia' LIMIT 1";


		$results_orcamento  = $database->get_row( $query_job );

		$msg_clie 	= preg_replace("/\[nome_cliente\]/",	$results_orcamento->nome_cliente, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_empresa\]/", 	$results_orcamento->nome_empresa, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_unidade\]/", 	$results_orcamento->nome_unidade, $msg_clie);
		$msg_clie 	= preg_replace("/\[nome_colaborador\]/",$results_orcamento->nome_colaborador, $msg_clie);		
		
		$msg_clie 	= preg_replace("/\[telefone\]/", 		$results_orcamento->telefone, $msg_clie);
		$msg_clie 	= preg_replace("/\[whatsapp\]/", 		$results_orcamento->whatsapp, $msg_clie);
		$msg_clie 	= preg_replace("/\[email\]/", 			$results_orcamento->email_colaborador, $msg_clie);

		$link_proposta = URL_UPLOAD."web4_logo_maker/?i=".base64_encode($results_orcamento->id_logomaker)."&u=".base64_encode($results_orcamento->id_unidade);

		$msg_clie 	= preg_replace("/\[link_proposta\]/", 	$link_proposta, $msg_clie);

  	}
  return $msg_clie;
}
