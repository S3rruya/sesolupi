<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* Título: Excluir médico */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

/* O Título do Modal se basea nesta linha (4), é utilizado a string após "Título: "
/* Título: Excluir médico */

//classes
include_once("../../classes/load_classes.php");

//gerando chave
$rand=microtime();
$_SESSION['rand']=$rand;

$database = new DB();

	$query_medicos = "SELECT * FROM medicos WHERE  medicos.id = '".$_GET['id']."' LIMIT 1";
	$results_medicos  = $database->get_row( $query_medicos );

?>
<!--html-->
<div class="alert alert-secondary text-center">
    <div id="contenthere">
        <h4 class="alert-heading">Deseja excluir ?</h4>
        <p><?php echo $results_medicos->nome;?></p>
        <p>
	   	   <div class="buttons">
    	        <button type="button" class="btn btn-danger rounded-pill medico_excluir" idmedico="<?php echo $_GET['id'];?>">Excluir</button>
    	       <button type="button" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
    	   </div>
        </p>
    </div>
</div>
