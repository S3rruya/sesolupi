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

	$query_fichas = "SELECT * FROM ficha_obito WHERE  ficha_obito.cliente = '".$_GET['id']."' ";
	$results_fichas  = $database->get_results( $query_fichas );
?>
<!--html-->


<div class="row match-height">
    <div class="col-md-12 col-12">
        <table class="table table-striped display tabelafull" id="tabelaobitos">
        	<thead>
        	    <tr>
        	        <th>Cód</th>
        	        <th>Falecido</th>
        	        <th>Declarante.</th>
        	        <th>Dt. Atestado</th>
        	        <th class="text-center">Ações</th>
        	    </tr>
        	</thead>
        	<tbody>
        		<?php 
        		foreach ($results_fichas as $key => $value) {

                    if($value['titular'] != "0"){
                        $query_falecido = "SELECT clientes.nome FROM clientes WHERE  clientes.id = '".$value['titular']."' LIMIT 1";
                        $falecido  = $database->get_row( $query_falecido );
                    }else{
                        $query_falecido = "SELECT dependentes.nome FROM dependentes WHERE  dependentes.id = '".$value['falecido']."' LIMIT 1";
                        $falecido  = $database->get_row( $query_falecido );
                    }

        		?>
        		<tr>
        			<td><?php echo $value['id'];?></td>
        			<td><?php echo $falecido->nome;?></td>
        			<td><?php echo $value['nome_declarante'];?></td>
        			<td><?php echo $value['data_obito'];?></td>
        			<td>
        				
        				<a href="#" class="open_modal" id="<?php echo $value['id'];?>" mtype="cliente_obito_documentos_b" print="1"><span class="badge bg-light-primary"><i class="far fa-file-word"></i> Declaração</span></a>
        				<a href="#" class="open_modal" id="<?php echo $value['id'];?>" mtype="cliente_obito_documentos_c" print="1"><span class="badge bg-light-primary"><i class="fas fa-receipt"></i> Termo/Recibo</span></a>

        			</td>
        		</tr>
        		<?php }?>
        	</tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
	


$('#tabelaobitos').DataTable({
    "responsive": true,
    "bLengthMenu" : false,
    "bLengthChange": false,
    "bInfo":false,  
    "pageLength": 50,
    "order": [[0, "desc"]],
    "columnDefs": [ {
        'targets': [4], /* column index [0,1,2,3]*/
        'orderable': false, /* true or false */
    }],

    "oLanguage": {
      "sProcessing":   "Processando...",
      "sLengthMenu":   "Mostrar  _MENU_ registros",
      "sZeroRecords":  "Não foram encontrados resultados",
      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty":    "",
      "sInfoFiltered": "",
      "sInfoPostFix":  "",
      "sSearch":       "Buscar: ",
      "sUrl":          "",
      "oPaginate": {
          "sFirst":    "Primeiro",
          "sPrevious": "Anterior",
          "sNext":     "Seguinte",
          "sLast":     "Último"
      }
  }
});    


</script>