<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Gestão de Dependentes */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Gestão de Dependentes */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();




?>
<div class="row match-height">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Adicionar Dependente</h4>
            </div>
            <div class="card-content">
                <div class="card-body" id="contenthere">
                    <div class="loadingform_inmodal"></div>
                    <div class="formarea_inmodal">
                    <form id="form_salva_dependente" class="form form-horizontal">
                        <input type="hidden" name="referencia_dependente" value="<?php echo $_GET['id'];?>">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nome</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" id="nome_dependente" class="form-control" name="nome_dependente" >
                                </div>
                                <div class="col-md-2">
                                    <label>CPF.</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" id="cpf_dependente" class="form-control cpf" name="cpf_dependente" >
                                </div>

                                <div class="col-md-2">
                                    <label>Dt. Nasc.</label>
                                </div>
                                <div class="col-md-2 form-group">
                                    <input type="date" id="dt_nascimento_dependente" class="form-control" name="dt_nascimento_dependente" >
                                </div>

                                <div class="col-md-2">
                                    <label>Parentesco</label>
                                </div>
                                <div class="col-md-2 form-group">
                                    <select class="form-select" name="parentesco_dependente" id="parentesco_dependente" required="required">
                                        <option value="1">Cônjuge</option>
                                        <option value="2">Companheiro (a)</option>
                                        <option value="3">Filho (a)</option>
                                        <option value="4">Pai</option>
                                        <option value="5">Mae</option>
                                        <option value="6">Irmão (a)</option>
                                        <option value="7">Sogro (a)</option>
                                        <option value="8">Neto (a)</option>
                                        <option value="9">Bisneto (a)</option>
                                        <option value="10">Sobrinho (a)</option>

                                        <option value="99">Outro (a)</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                     <label>Dt. Adesão</label>
                                </div>
                                <div class="col-md-2 form-group">
                                    <input type="date" id="dt_adesao_dependente" class="form-control" name="dt_adesao_dependente">
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button class="btn btn-primary salva_dependente">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row match-height">
    <div class="col-md-12 col-12">
        <table class="table table-striped display tabelafull" id="tabeladependentes">
        	<thead>
        	    <tr>
        	        <th>Cód</th>
        	        <th>Nome</th>
                    <th>CPF</th>
        	        <th>Dt Nascimento.</th>
        	        <th>Parentesco</th>
        	        <th>Dt. Adesão</th>
        	        <th>Óbito</th>
        	        <th>Dt. obito</th>
        	        <th>Obs</th>
        	        <th class="text-center">Ações</th>
        	    </tr>
        	</thead>
        	<tbody>


        	</tbody>
        </table>
    </div>
</div>




<script type="text/javascript">


atualizalista();
function atualizalista() {
$('#tabeladependentes').DataTable({
    "destroy": true,
    "processing":true,
    "responsive": true,
    "pageLength": 10,
    "ordering": false,
    //"order": [[3, "desc"]],
    "columnDefs": [ {
        'targets': [8,9], /* column index [0,1,2,3]*/
        'orderable': false, /* true or false */
    }],
    "ajax": {
       url: 'z-ajax.php?action=getdependentes&referencia=<?php echo $_GET['id'];?>',
       method: "GET",
       dataType: 'json',
       xhrFields: {
           withCredentials: true
       }
    },
  

    "columns": [
        { data: "id" },
        { data: "nome" },
        { data: "cpf_dependente" },
        { data: "dt_nascimento" },
        { data: "parentesco" },
        { data: "dt_adesao"},
        { data: "obito"},
        { data: "dt_falecimento"},
        { data: "observacao"},
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