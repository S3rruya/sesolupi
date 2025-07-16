<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Gestão de Contrato */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Gestão de Contrato */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

	$query_cliente_contrato = "SELECT *,
	 day(dt_adesao) AS dia_adesao,
      (CASE month(dt_adesao) 
         when 1 then 'Janeiro'
         when 2 then 'Fevereiro'
         when 3 then 'Março'
         when 4 then 'Abril'
         when 5 then 'Maio'
         when 6 then 'Junho'
         when 7 then 'Julho'
         when 8 then 'Agosto'
         when 9 then 'Setembro'
         when 10 then 'Outubro'
         when 11 then 'Novembro'
         when 12 then 'Dezembro'
         END) AS mes_adesao,
      year(dt_adesao) AS ano_adesao
         
         FROM clientes WHERE  clientes.id = '".$_GET['id']."' LIMIT 1";
	$results_cliente_contrato  = $database->get_row( $query_cliente_contrato );




if ($results_cliente_contrato->tipo =="M") {
?>
<div id="printarea<?php echo $results_cliente_contrato->id?>">
	<div class="contratologo"></div>
	<div class="contratobody">
		<p class="text-center"><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</b></p>
		<p>Por este  instrumento particular de prestação de Serviços, de um lado a SESOLUPI Serviço Social de Luto Pindamonhangaba no Estado de São Paulo, Município de Pindamonhangaba, na Rua Major José dos Santos Moreira, 703, devidamente inscrita no C.G.C. /M.F. sob o número 01.946.584/0001-55  e Inscrição Estadual número isento, doravante denominada CONTRATADA, e de outro lado <?php echo $results_cliente_contrato->nome;?> RG nº  <?php echo $results_cliente_contrato->rg;?> e CPF <?php echo $results_cliente_contrato->cpf;?> , doravante denominado CONTRATANTE, vem, mutuamente, celebrar o presente contrato nos seguintes termos e condições:</p>
		<p class="text-center"><b>I - DO OBJETIVO</b></p>
		<p>1.1 - O presente instrumento tem como objetivo a prestação de serviços funerários.</p>
		<p>1.2 - Inclui-se na referida prestação o estipulado nesta cláusula contratual:</p>
			<ol type="a">
				<li>- Urna Mortuária de Madeira envernizada de nº 05 (alça dura), PADRÃO.</li>
				<li>- Serviços de auto fúnebre (50 Km de raio).</li>
				<li>- Ornamentação de urna mortuária.</li>
				<li>- Véu para urna Mortuária.</li>
				<li>- Montagem de câmara ardente.</li>
				<li>- Aluguel da sala de velório SESOLUPI, (havendo vaga).</li>
			</ol>
		<p class="text-center"><b>II - DAS ESPECIFICAÇÕES</b></p>
		<p>2.1 - Cabe a CONTRATADA cobrar dos familiares beneficiários a diferença de urna quando for necessário o uso de serviços especiais como: Urna comprida (acima de 1,90 metros), Urna extra grande (acima de 105 quilos), Urna zincada, Urna Branca ou Urna de Luxo, caso os familiares optem pelo serviço fora do estipulado no contrato.</p>
		<p>2.2 - Cabe também cobrar do usuário a sala de velório, quando não for utilizada a sala especificada no contrato.</p>
		<p class="text-center"><b>III - DOS USUÁRIOS</b></p>
		<p>3.1 - Serão considerados dependentes todas as pessoas relacionadas na ficha de inscrição, que faz parte integrante deste instrumento particular de prestação de serviços. </p>
		<p>3.2 - Os serviços acima relacionados serão extensivos a todos os dependentes.</p>
		<p>3.3 - Após a assinatura deste, será contada uma carência de 90 (noventa) dias quando então a SESOLUPI se obriga a prestar os serviços</p>
		<p>3.4 - Os dependentes Inscritos e ou substituídos após a carência acima referida, deverão respeitar a carência prevista na clausula 3.3.</p>
		<p>3.5 - Caso haja evento Mortis durante o período de Carência, a CONTRATANTE ou seus beneficiários terão um desconto de 20% na execução do Serviço.</p>
		<p class="text-center"><b>IV- DOS VALORES, FORMAS DE PAGAMENTO E VIGÊNCIA</b></p>
		<p>4.1 - O CONTRATANTE se compromete a pagar a CONTRATADA, um valor referente a 1 salário mínimo vigente na data da assinatura deste instrumento.</p>
		<p>4.2 - O valor acima estipulado deverá ser pago a CONTRATADA em 12 (doze) parcelas sendo  1(uma) entrada e mais 11 (onze) iguais e sem acréscimo.</p>
		<p>4.3 - Os vencimentos das parcelas acima estipulada, deverão ser sempre no dia <?php echo $results_cliente_contrato->vencimento;?> de cada mês, subsequentes a data de assinatura deste instrumento.</p>
		<p>4.4 - A primeira parcela deverá ser paga no ato da assinatura deste instrumento.</p>
		<p>4.5 - Visando manter o presente contrato ATIVO, a CONTRATANTE pagará a CONTRATADA anualmente o valor correspondente a 50% do salário mínimo vigente na época do pagamento. Sendo dividido em 12(doze) parcelas iguais</p>
		<p>4.6 - A anuidade acima será COBRADA todos os anos após a assinatura deste, conforme datas fixadas em correspondências futuras.</p>
		<p>4.7 – Este contrato tem validade a partir da data de sua assinatura e terá vigência de 60 meses (5 anos). Renovando automaticamente a cada ano (12 meses), por prazo indeterminado, salvo quando houver manifestação expressa em contrário por uma das partes com antecedência mínima de 30 dias, estando vigente por prazo indeterminado, qualquer das partes poderá rescindi-lo mediante aviso por escrito com antecedência de 30 (trinta) dias.</p>
		<p class="text-center"><b>V- DOS EVENTOS MORTIS ACONTECIDOS EM OUTRAS LOCALIDADES</b></p>
		<p>5.1 - A CONTRATADA se obriga a prestar atendimento dentro do município de Pindamonhangaba.</p>
		<p>5.2 - Se o CONTRATANTE ou um de seus dependentes desejar que se remova o corpo do falecido de dentro para fora ou vice-versa do município de Pindamonhangaba, deverá pagar uma taxa extra equivalente ao preço de 1 (hum) litro de gasolina por cada quilometro excedente.</p>
		<p>5.3 - Não haverá ressarcimento se o serviço for prestado por outra empresa congênere dentro do Município de Pindamonhangaba.</p>
		<p class="text-center"><b>VI- DISPOSIÇÕES GERAIS</b></p>
		<p>6.1 - Em caso de falecimento, a CONTRATADA deverá ser notificada imediatamente para que possa dar início aos procedimentos normais, caso não haja a comunicação do óbito, a CONTRATADA se isenta das obrigações contratuais. </p>
		<p>6.2 - A CONTRATADA não prestar o atendimento pactuado quando houver atraso de 02 (dois) meses no pagamento das parcelas.</p>
		<p>6.3 - É facultado a CONTRATADA fazer o cancelamento sem prévio aviso na falta de atualização de endereço para correspondência, impossibilitando assim a cobrança das Taxas</p>
		<p>6.4 - Suspende-se para todos os fins de fato e de direito este contrato em caso de calamidade pública catástrofes, revolução, guerra civil ou epidemia.</p>
		<p>6.5 - Fica eleito o fórum da comarca de Pindamonhangaba para dirimir as dúvidas oriundas do presente instrumento, com renuncia expressa de qualquer outro, por mais privilegiado que seja. </p>

		<p>E assim, por estarem justos e contratados, assinam o presente instrumento na presença de testemunhas.</p>







<!-- dependentes -->
<table width="100%" class="table-bordered">
	<thead>
		<tr>
			<td colspan="7" class="text-center">Dependentes</td>
		</tr>

		<tr>

			<th>Nome</th>
	        <th>Dt Nascimento.</th>
	        <th>Parentesco</th>
	        <th>Dt. Adesão</th>
	        <th>Óbito</th>
	        <th>Dt. obito</th>
	        
		</tr>

	</thead>
	<tbody>



<?php




	$clientes_parciais = "SELECT dependentes.*, parentesco.nome AS nomeparentesco,

	DATE_FORMAT(dependentes.dt_nascimento,'%d/%m/%Y ') AS nice_dt_nascimento,
	DATE_FORMAT(dependentes.dt_adesao,'%d/%m/%Y ') AS nice_dt_adesao,
	DATE_FORMAT(dependentes.dt_falecimento,'%d/%m/%Y ') AS nice_dt_falecimento

	FROM dependentes 
	LEFT JOIN parentesco ON parentesco.id = dependentes.parentesco
	WHERE referencia='".$results_cliente_contrato->id."' ORDER by dt_adesao DESC";
	$resultados_clientes_parciais = $database->get_results($clientes_parciais);

	
   	foreach ($resultados_clientes_parciais as $key ) {

   	if($key['obito'] == "1"){
			$status = '<span class="badge bg-primary">Sim</span>';
		}else{
			$status = '<span class="badge bg-secondary">Não</span>';
		}

?>
<tr>
	
	<td ><?php echo $key['nome'];?></td>
	<td ><?php echo $key['nice_dt_nascimento'];?></td>
	<td ><?php echo $key['nomeparentesco'];?></td>
	<td ><?php echo $key['nice_dt_adesao'];?></td>
	<td ><?php echo $status;?></td>
	<td ><?php echo $key['nice_dt_falecimento'];?></td>
</tr>
<?php } ?>
	</tbody>
</table>
<!-- dependentes -->


		<p class="mb-5" style="text-align: right;">Pindamonhangaba, <?php echo $results_cliente_contrato->dia_adesao;?> de <?php echo $results_cliente_contrato->mes_adesao;?> de <?php echo $results_cliente_contrato->ano_adesao;?></p>

		<table width="100%">
			<tr>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
			</tr>
			<tr>
				<td width="25%" class="text-center">Contratante</td>
				<td width="25%" class="text-center">Contratada</td>
				<td width="25%" class="text-center">Testemunha</td>
				<td width="25%" class="text-center">Testemunha</td>
			</tr>	
		</table>
		</div>
</div>
<?php 
} 

elseif ($results_cliente_contrato->tipo =="A") {
?>
<div id="printarea<?php echo $results_cliente_contrato->id?>">
	<div class="contratologo"></div>
	<div class="contratobody" >
		<p class="text-center"><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</b></p>
		<p>Por este  instrumento particular de prestação de Serviços, de um lado a SESOLUPI Serviço Social de Luto Pindamonhangaba no Estado de São Paulo, Município de Pindamonhangaba, na Rua Major José dos Santos Moreira, 703, devidamente inscrita no C.G.C. /M.F. sob o número 01.946.584/0001-55  e Inscrição Estadual número isento, doravante denominada CONTRATADA, e de outro lado <?php echo $results_cliente_contrato->nome;?> RG nº  <?php echo $results_cliente_contrato->rg;?> , doravante denominado CONTRATANTE, vem, mutuamente, celebrar o presente contrato nos seguintes termos e condições:</p>
		<p class="text-center"><b>I - DO OBJETIVO</b></p>
		<p>1.1 - O presente instrumento tem como objetivo a prestação de serviços funerários.</p>
		<p>1.2 - Inclui-se na referida prestação o estipulado nesta cláusula contratual:</p>
			<ol type="a">
				<li>- Urna Mortuária de Madeira envernizada de nº 05 (alça dura), PADRÃO.</li>
				<li>- Serviços de auto fúnebre (50 Km de raio).</li>
				<li>- Ornamentação de urna mortuária.</li>
				<li>- Véu para urna Mortuária.</li>
				<li>- Montagem de câmara ardente.</li>
				<li>- Aluguel da sala de velório SESOLUPI, (havendo vaga).</li>
			</ol>
		<p class="text-center"><b>II - DAS ESPECIFICAÇÕES</b></p>
		<p>2.1 - Cabe a CONTRATADA cobrar dos familiares beneficiários a diferença de urna quando for necessário o uso de serviços especiais como: Urna comprida (acima de 1,90 metros), Urna extra grande (acima de 105 quilos), Urna zincada, Urna Branca ou Urna de Luxo, caso os familiares optem pelo serviço fora do estipulado no contrato.</p>
		<p>2.2 - Cabe também cobrar do usuário a sala de velório, quando não for utilizada a sala especificada no contrato.</p>
		<p class="text-center"><b>III - DOS USUÁRIOS</b></p>
		<p>3.1 - Serão considerados dependentes todas as pessoas relacionadas na ficha de inscrição, que faz parte integrante deste instrumento particular de prestação de serviços. </p>
		<p>3.2 - Os serviços acima relacionados serão extensivos a todos os dependentes.</p>
		<p>3.3 - Após a assinatura deste, será contada uma carência de 90 (noventa) dias quando então a SESOLUPI se obriga a prestar os serviços</p>
		<p>3.4 - Os dependentes Inscritos e ou substituídos após a carência acima referida, deverão respeitar a carência prevista na clausula 3.3.</p>
		<p>3.5 - Caso haja evento Mortis durante o período de Carência, a CONTRATANTE ou seus beneficiários terão um desconto de 20% na execução do Serviço.</p>
		<p class="text-center"><b>IV- DOS VALORES, FORMAS DE PAGAMENTO E VIGÊNCIA</b></p>
		<p>4.1 - O CONTRATANTE se compromete a pagar a CONTRATADA, um valor referente a 1 salário mínimo vigente na data da assinatura deste instrumento.</p>
		<p>4.2 - O valor acima estipulado deverá ser pago a CONTRATADA em quatro parcelas iguais e sem acréscimo.</p>
		<p>4.3 - Os vencimentos das parcelas acima estipulada, deverão ser sempre no dia <?php echo $results_cliente_contrato->vencimento;?> de cada mês, subsequentes a data de assinatura deste instrumento.</p>
		<p>4.4 - A primeira parcela deverá ser paga no ato da assinatura deste instrumento.</p>
		<p>4.5 - Visando manter o presente contrato ATIVO, a CONTRATANTE pagará a CONTRATADA anualmente o valor correspondente a 50% do salário mínimo vigente na época do pagamento.</p>
		<p>4.6 - A anuidade acima será COBRADA todos os anos após a assinatura deste, conforme datas fixadas em correspondências futuras.</p>
		<p>4.7 – Este contrato tem validade a partir da data de sua assinatura e terá vigência de 60 meses (5 anos). Renovando automaticamente a cada ano (12 meses), por prazo indeterminado, salvo quando houver manifestação expressa em contrário por uma das partes com antecedência mínima de 30 dias, estando vigente por prazo indeterminado, qualquer das partes poderá rescindi-lo mediante aviso por escrito com antecedência de 30 (trinta)dias.</p>
		<p class="text-center"><b>V- DOS EVENTOS MORTIS ACONTECIDOS EM OUTRAS LOCALIDADES</b></p>
		<p>5.1 - A CONTRATADA se obriga a prestar atendimento dentro do município de Pindamonhangaba.</p>
		<p>5.2 - Se o CONTRATANTE ou um de seus dependentes desejar que se remova o corpo do falecido de dentro para fora ou vice-versa do município de Pindamonhangaba, deverá pagar uma taxa extra equivalente ao preço de 1 (hum) litro de gasolina por cada quilometro excedente.</p>
		<p>5.3 - Não haverá ressarcimento se o serviço for prestado por outra empresa congênere dentro do Município de Pindamonhangaba.</p>
		<p class="text-center"><b>VI- DISPOSIÇÕES GERAIS</b></p>
		<p>6.1 - Em caso de falecimento, a CONTRATADA deverá ser notificada imediatamente para que possa dar início aos procedimentos normais, caso não haja a comunicação do óbito, a CONTRATADA se isenta das obrigações contratuais. </p>
		<p>6.2 - A CONTRATADA não prestar o atendimento pactuado quando houver atraso de 02 (dois) meses no pagamento das parcelas.</p>
		<p>6.3 - É facultado a CONTRATADA fazer o cancelamento sem prévio aviso na falta de atualização de endereço para correspondência, impossibilitando assim a cobrança das Taxas</p>
		<p>6.4 - Suspende-se para todos os fins de fato e de direito este contrato em caso de calamidade pública catástrofes, revolução, guerra civil ou epidemia.</p>
		<p>6.5 - Fica eleito o fórum da comarca de Pindamonhangaba para dirimir as dúvidas oriundas do presente instrumento, com renuncia expressa de qualquer outro, por mais privilegiado que seja. </p>

		<p>E assim, por estarem justos e contratados, assinam o presente instrumento na presença de testemunhas.  </p>




<!-- dependentes -->
<table width="100%" class="table-bordered">
	<thead>
		<tr>
			<td colspan="7" class="text-center">Dependentes</td>
		</tr>

		<tr>

			<th>Nome</th>
	        <th>Dt Nascimento.</th>
	        <th>Parentesco</th>
	        <th>Dt. Adesão</th>
	        <th>Óbito</th>
	        <th>Dt. obito</th>
	        
		</tr>

	</thead>
	<tbody>



<?php

	
	$clientes_parciais = "SELECT dependentes.*, parentesco.nome AS nomeparentesco,

	DATE_FORMAT(dependentes.dt_nascimento,'%d/%m/%Y ') AS nice_dt_nascimento,
	DATE_FORMAT(dependentes.dt_adesao,'%d/%m/%Y ') AS nice_dt_adesao,
	DATE_FORMAT(dependentes.dt_falecimento,'%d/%m/%Y ') AS nice_dt_falecimento

	FROM dependentes 
	LEFT JOIN parentesco ON parentesco.id = dependentes.parentesco
	WHERE referencia='".$results_cliente_contrato->id."' ORDER by dt_adesao DESC";
	$resultados_clientes_parciais = $database->get_results($clientes_parciais);

	
   	foreach ($resultados_clientes_parciais as $key ) {


   	if($key['obito'] == "1"){
			$status = '<span class="badge bg-primary">Sim</span>';
		}else{
			$status = '<span class="badge bg-secondary">Não</span>';
		}
?>
<tr>
	
	<td ><?php echo $key['nome'];?></td>
	<td ><?php echo $key['nice_dt_nascimento'];?></td>
	<td ><?php echo $key['nomeparentesco'];?></td>
	<td ><?php echo $key['nice_dt_adesao'];?></td>
	<td ><?php echo $status;?></td>
	<td ><?php echo $key['nice_dt_falecimento'];?></td>
</tr>
<?php } ?>
	</tbody>
</table>
<!-- dependentes -->


		<p class="mb-5" style="text-align: right;">Pindamonhangaba, <?php echo $results_cliente_contrato->dia_adesao;?> de <?php echo $results_cliente_contrato->mes_adesao;?> de <?php echo $results_cliente_contrato->ano_adesao;?></p>

		<table width="100%">
			<tr>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
				<td width="25%" class="text-center">_______________________</td>
			</tr>
			<tr>
				<td width="25%" class="text-center">Contratante</td>
				<td width="25%" class="text-center">Contratada</td>
				<td width="25%" class="text-center">Testemunha</td>
				<td width="25%" class="text-center">Testemunha</td>
			</tr>	
		</table>
	</div>
</div>
<?php } ?>
<style type="text/css">
  .contratologo{
    background-image: url("<?php echo URL_UPLOAD;?>assets/images/logo/logo.png");
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
	

</style>