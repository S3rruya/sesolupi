<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Gestão de Financeiro */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Gestão de Financeiro */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

?>
<!--html-->
<div class="row match-height">
    <div class="col-md-12 col-12">
        <div class="card">

            <div class="card-content">
                <div class="card-body" id="contenthere">
                    <div class="loadingform_inmodal"></div>
                    <div class="formarea_inmodal">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row match-height">
    <div class="col-md-12 col-12">

        <table class="table table-striped display tabelafull" id="tabelafinanceiro">
        	<thead>
        	    <tr>
        	        <th>Cód</th>    	        
                    <th>Valor</th>
        	        <th>Pagamento</th>
        	        <th>Status</th>
        	        
        	        <th>Vencimento</th>
        	        <th>Pagamento</th>
        	        <th class="text-center">Ações</th>
        	    </tr>
        	</thead>
        	<tbody>


        	</tbody>
        </table>
    </div>
</div>




<script type="text/javascript">


atualiza_financeiro();
function atualiza_financeiro() {
$('#tabelafinanceiro').DataTable({
    "destroy": true,
    "processing":true,
    "responsive": true,
    "pageLength": 20,
    "order": [[0, "asc"]],
    "columnDefs": [ {
        'targets': [0,1,2,3,4,5,6], /* column index [0,1,2,3]*/
        'orderable': false, /* true or false */
    }],
    "ajax": {
       url: 'z-ajax.php?action=getfinanceiro&cliente=<?php echo $_GET['id'];?>',
       method: "GET",
       dataType: 'json',
       xhrFields: {
           withCredentials: true
       }
    },
    "columns": [
        { data: "id" },
        { data: "valor" },
        { data: "valor_pagamento" },
        { data: "status"},

        { data: "dt_vencimento"},
        { data: "dt_pagamento"},
        { data: "action"},
        /*and so on, keep adding data elements here for all your columns.*/
    ],
    "dom": 'Bfrtip',
    "buttons": [{
        extend: 'print',
        "text": '<i class="fas fa-print"></i> Imprimir',
        exportOptions: {
            columns: [ 0,1,2,3,4,5,6,7 ]
        },
        customize: function ( win ) {
        $(win.document.body)
            .prepend('<img src="<?php echo URL_UPLOAD;?>assets/images/logo/logo.png" style="width:80px; height:80px; float:left; top:0; left:0;" />');
        },
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

}
</script>