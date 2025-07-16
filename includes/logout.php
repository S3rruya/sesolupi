<?php
/* NIVEL DE ACESSO */
/* level 10 */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */
/* NIVEL 10 = TOTALMENTE LIBERADO */



if(@$link['1']=="confirmar_saida"){
    @session_start();
    @session_destroy();


?>
<section class="section">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Você deseja realmente sair?</h4>
                </div>
                <div class="card-body">
				<p>... aguarde...</p>
	      		<?php
				      echo '<meta http-equiv="refresh" content="1;URL='.URL_UPLOAD.'" />';
				    ?>
          		</div>
        	</div>
      	</div>
    </div>
</section>
<?php
}else{
?>
<section class="section">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Você deseja realmente sair?</h4>
                </div>
                <div class="card-body">
                    <div class="badges">
                        <a href="controle/logout/confirmar_saida"><span class="badge bg-primary">Sim</span></a>
                        <a href="controle/"><span class="badge bg-secondary">Não</span></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php }?>