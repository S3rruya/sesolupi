<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

$database = new DB();


?>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">                        
                               <div class="col-lg-9" style="padding-left: 1.5em;">
                                <h3>
                                    Gestão de óbitos
                                    
                                </h3>
                                </div>
                          <div class="col-lg-3 d-grid" style="padding-right: 1.5em;">
                                    <a href="#" class="btn btn-primary open_modal" id="registrar_obito" mtype="cliente"><i class="bi fas fa-cross"></i> &nbsp;&nbsp; Registrar óbito </a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Cód</th>
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>Tel.</th>
                                        <th>Cel.</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $clientes_parciais = 'SELECT tipo, codigo_cliente, nome, tel_res, tel_cel, status, dt_adesao FROM clientes ORDER by dt_adesao DESC';
                                    $resultados_clientes_parciais = $database->get_results($clientes_parciais);
                                    foreach ($resultados_clientes_parciais as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['codigo_cliente'];?></td>
                                        <td><?php //echo $value['tipo'];?>
                                        <?php if($value['tipo'] == "A"){?>
                                            <span class="badge bg-primary">A</span>
                                        <?php }else{?>
                                            <span class="badge bg-secondary">M</span>
                                        <?php }?>
                                        </td>
                                        <td><?php echo $value['nome'];?></td>
                                        <td><?php echo $value['tel_res'];?></td>
                                        <td><?php echo $value['tel_cel'];?></td>
                                        <td>
                                            <?php if($value['status'] == "1"){?>
                                            <span class="badge bg-primary">Ativo</span>
                                            <?php }else{?>
                                                <span class="badge bg-secondary">Inativo</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-primary"><i class="far fa-file-word"></i> Registro de óbito</span>

                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 <!-- ... Modal de obito aqui ... -->
   <!--login form Modal -->
   <!--login form Modal -->
 
                
                
                 <div class="container" id="cliente_obito_modal">
                     <button id="close-modal-obito">x</button>
	<div class="loadingform"></div>
	<div class="formarea">
		<div class="stepwizard">
		    <div class="stepwizard-row setup-panel row">
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-1" type="button" class="rounded-pill btn btn-primary">1</a>
		            <p>Passo 1<br>
					<small>Falecido</small></p>
		        </div>
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-2" type="button" class="rounded-pill btn btn-secondary" disabled="disabled">2</a>
		            <p>Passo 2<br>
					<small>Óbito</small></p>
		        </div>
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-3" type="button" class="rounded-pill btn btn-secondary" disabled="disabled">3</a>
		            <p>Passo 3<br>
					<small>Declarante</small></p>
		        </div>
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-4" type="button" class="rounded-pill btn btn-secondary" disabled="disabled">4</a>
		            <p>Passo 4<br>
		            <small>Médico declarante</small></p>
		        </div>
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-5" type="button" class="rounded-pill btn btn-secondary" disabled="disabled">5</a>
		            <p>Passo 5<br>
		            <small>Filhos</small></p>
		        </div>
		        <div class="stepwizard-step col text-center indicadorstep">
		            <a href="#step-6" type="button" class="rounded-pill btn btn-secondary" disabled="disabled">6</a>
		            <p>Passo 6<br>
					<small>Estado Civil</small></p>
		        </div>
		    </div>
		</div>
		<form role="form" id="obitoform">
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			<div class="row setup-content" id="step-1">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Falecido:</h3>
		                <div class="bodystep" id="step-1-body">
						<div class="row">
							<div class="col">
						  		
						  		<div class="form-check">
		                            <input class="form-check-input" style="width:300px; height:35px;" type="text" name="falecido_check" id="titular<?php echo $_GET['id'];?>" value="<?php echo $_GET['id'];?>">
		                            <label class="form-check-label" for="titular<?php echo $_GET['id'];?>">
		                                <?php echo $results_clientes->nome;?>
		                            </label>
		                        </div>
						  	</div>
							<?php 
							foreach ($resultados_depedentes as $key => $value) {
								//print_r($value);
							?>
							<div class="col">
								<div class="form-check">
		                            <input class="form-check-input" type="text" name="falecido_check" id="dependente<?php echo $key;?>" value="<?php echo $_GET['id'];?>.<?php echo $value['id'];?>">
		                            <label class="form-check-label" for="dependente<?php echo $key;?>">
		                                <?php echo $value['nome'];?> (<?php echo $value['nomeparentesco'];?>)
		                            </label>
		                        </div>

						  		
						  	</div>
						  <?php } ?>
						</div>
						</div>
					

					</div>
				</div>
			</div>    

		    <div class="row setup-content" id="step-2">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Óbito</h3>
		                <div class="bodystep">
						<div class="row">
							<div class="col-md-2">
						  		<label for="numero_declaracao">Declaração:</label>
						  	</div>
						  	<div class="col-md-4 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="numero_declaracao" id="numero_declaracao" type="text">
							</div>
							<div class="col-md-1">
						  		<label for="data_obito">Dt Óbito:</label>
						  	</div>
						  	<div class="col-md-5 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="data_obito" id="data_obito" type="date">
							</div>
						</div>	
						<div class="row">
							<div class="col-md-2">
						  		<label for="local_obito">Local:</label>
						  	</div>
						  	<div class="col-md-10 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="local_obito" id="local_obito" type="text">
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
						  		<label for="hora_obito">Hora óbito:</label>
						  	</div>
						  	<div class="col-md-4 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="hora_obito" id="hora_obito" type="text">
							</div>
							<div class="col-md-3">
						  		<label for="hora_sepultamento">Hora Sepultamento:</label>
						  	</div>
						  	<div class="col-md-3 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="hora_sepultamento" id="hora_sepultamento" type="text">
							</div>
						</div>	
						<div class="row">
							<div class="col-md-2">
						  		<label for="cemiterio">Cemitério:</label>
						  	</div>
						  	<div class="col-md-4 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="cemiterio" id="cemiterio" type="text" value="Cemitério Municipal">
							</div>
							<div class="col-md-2">
						  		<label for="cidade_cemiterio">Cidade:</label>
						  	</div>
						  	<div class="col-md-4 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="cidade_cemiterio" id="cidade_cemiterio" type="text" value="Pindamonhangaba">
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
						  		<label for="quadra_cemiterio">Quadra:</label>
						  	</div>
						  	<div class="col-md-1 form-group">
								<input class="form-control" data-error="Campo necessário"  name="quadra_cemiterio" id="quadra_cemiterio" type="text">
							</div>
							<div class="col-md-2">
						  		<label for="perpetuo">Perpétuo:</label>
						  	</div>
						  	<div class="col-md-1 form-group">
						  		<input type="checkbox" id="perpetuo" name="perpetuo"  class="form-check-input" value="s" >
							</div>
							<div class="col-md-2">
						  		<label for="deixa_bens">Deixa bens:</label>
						  	</div>
						  	<div class="col-md-1 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="deixa_bens" id="deixa_bens" type="text">
							</div>
							<div class="col-md-2">
						  		<label for="testamento">Testamento:</label>
						  	</div>
						  	<div class="col-md-1 form-group">
								<input class="form-control" data-error="Campo necessário"   name="testamento" id="testamento" type="text">
							</div>
						</div>
						</div>
						<div class="row">
							<!--<div class="col-md-12 text-right">-->
		     <!--           		<button class="btn btn-primary nextBtn btn-lg" type="button" id="next-prd">Próximo</button>-->
		     <!--           	</div>-->
		                </div>
					</div>
				</div>
			</div>


		    <div class="row setup-content" id="step-3">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Declarante</h3>
		                <div class="bodystep">
							<div class="row">
								<div class="col-md-2">
							  		<label for="nome_declarante">Nome:</label>
							  	</div>
							  	<div class="col-md-10 form-group">
									<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"  required="required" name="nome_declarante" id="nome_declarante" type="text">
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
							  		<label for="cpf_declarante">CPF:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control cpf" data-error="Campo necessário"  required="required" name="cpf_declarante" id="cpf_declarante" type="text">
								</div>
								<div class="col-md-1">
							  		<label for="rg_declarante">RG:</label>
							  	</div>
							  	<div class="col-md-5 form-group">
									<input class="form-control rg" data-error="Campo necessário"  required="required" name="rg_declarante" id="rg_declarante" type="text">
								</div>
							</div>	
							

							<div class="row">
								<div class="col-md-2">
							  		<label for="cep_declarante">CEP:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control cep" data-error="Campo necessário"  required="required" name="cep_declarante" id="cep_declarante" type="text">
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
							  		<label for="endereco_declarante">Endereço:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="endereco_declarante" id="endereco_declarante" type="text">
								</div>

								<div class="col-md-1">
							  		<label for="numero_declarante">Nº:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="numero_declarante" id="numero_declarante" type="text">
								</div>

								<div class="col-md-1">
							  		<label for="complemento_declarante">Compl.:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário" name="complemento_declarante" id="complemento_declarante" type="text">
								</div>

								<div class="col-md-2">
							  		<label for="bairro_declarante">Bairro:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="bairro_declarante" id="bairro_declarante" type="text">
								</div>


								<div class="col-md-1">
							  		<label for="cidade_declarante">Cidade:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="cidade_declarante" id="cidade_declarante" type="text">
								</div>

								<div class="col-md-1">
							  		<label for="estado_declarante">UF:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<select class="form-select" name="estado_declarante" id="estado_declarante" required="required">
									    <option value="AC">AC</option>
									    <option value="AL">AL</option>
									    <option value="AP">AP</option>
									    <option value="AM">AM</option>
									    <option value="BA">BA</option>
									    <option value="CE">CE</option>
									    <option value="DF">DF</option>
									    <option value="ES">ES</option>
									    <option value="GO">GO</option>
									    <option value="MA">MA</option>
									    <option value="MT">MT</option>
									    <option value="MS">MS</option>
									    <option value="MG">MG</option>
									    <option value="PA">PA</option>
									    <option value="PB">PB</option>
									    <option value="PR">PR</option>
									    <option value="PE">PE</option>
									    <option value="PI">PI</option>
									    <option value="RJ">RJ</option>
									    <option value="RN">RN</option>
									    <option value="RS">RS</option>
									    <option value="RO">RO</option>
									    <option value="RR">RR</option>
									    <option value="SC">SC</option>
									    <option value="SP">SP</option>
									    <option value="SE">SE</option>
									    <option value="TO">TO</option>
									</select>

								</div>
							</div>	

							<div class="row">
								<div class="col-md-2">
							  		<label for="tel_res_declarante">Tel Res:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control telefone" data-error="Campo necessário" required="required"  name="tel_res_declarante" id="tel_res_declarante" type="text" value="12 ">
								</div>

								<div class="col-md-2">
							  		<label for="tel_cel_declarante">Tel Celular:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control celular" data-error="Campo necessário"  required="required" name="tel_cel_declarante" id="tel_cel_declarante" type="text" value="12 ">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
		                		<!--<button class="btn btn-primary nextBtn btn-lg" type="button"  id="next-prd" >Próximo</button>-->
		                	</div>
		                </div>

		            </div>
		        </div>
		    </div>
		    <div class="row setup-content" id="step-4">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Médico declarante</h3>

		                <div class="bodystep">
						<div class="row">
							<div class="col-md-2">
						  		<label for="nome_medico">Médico:</label>
						  	</div>
						  	<div class="col-md-5 form-group">
								<input class="form-control" placeholder="Nome médico" data-error="Campo necessário"  required="required" name="nome_medico" id="nome_medico" type="text">
							</div>
							<div class="col-md-2">
						  		<label for="crm_medico">CRM:</label>
						  	</div>
						  	<div class="col-md-3 form-group">
								<input class="form-control" data-error="Campo necessário"  required="required" name="crm_medico" id="crm_medico" type="text">
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
						  		<label for="dt_assinatura">Dt assin. atestado:</label>
						  	</div>
						  	<div class="col-md-5 form-group">
								<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"  required="required" name="dt_assinatura" id="dt_assinatura" type="date">
							</div>
						

							<div class="col-md-2">
						  		<label for="telefone_medico">Telefone:</label>
						  	</div>
						  	<div class="col-md-3 form-group">
								<input class="form-control celular" data-error="Campo necessário"  required="required" name="telefone_medico" id="telefone_medico" type="text" value="12 ">
							</div>

						</div>
						<div class="row">
							<div class="col-md-2">
						  		<label for="causa_morte">Causa morte:</label>
						  	</div>
						  	<div class="col-md-8 form-group">
						  		 <div class="form-group with-title mb-3">
		                            <textarea class="form-control" name="causa_morte" id="causa_morte" rows="3"></textarea>
		                            <label class="labelfina">Detalhar causa da morte</label>
		                        </div>
								
							</div>
						</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
		                		<!--<button class="btn btn-primary nextBtn btn-lg pull-right" type="button"  id="next-prd" >Próximo</button>-->
		                	</div>
		                </div>
		                

		            </div>
		        </div>
		    </div>

		    <div class="row setup-content" id="step-5">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Filhos</h3>
						<div class="bodystep">
						<div class="row">
							<div class="col-md-2">
						  		<label for="nomefilho">Nome:</label>
						  	</div>
						  	<div class="col-md-6 form-group">
								<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"   name="filhonome[]" id="nomefilho" type="text">
							</div>
							<div class="col-md-1">
						  		<label for="idadefilho">Idade:</label>
						  	</div>
						  	<div class="col-md-2 form-group">
								<input class="form-control" data-error="Campo necessário"   name="idadefilho[]" id="idadefilho" type="text">
							</div>
							<div class="col-md-1 form-group">
								<a href="#" class="btn btn-success">+</a>
							</div>
						</div>
						</div>
						<div class="row">
							<!--<div class="col-md-12 text-right">-->
		     <!--           		<button class="btn btn-primary nextBtn btn-lg pull-right" type="button"  id="next-prd" >Próximo</button>-->
		     <!--           	</div>-->
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="row setup-content" id="step-6">
		        <div class="col-xs-12">
		            <div class="col-md-12">
		                <h3> Estado Civil</h3>
		                <div class="bodystep">
							<div class="row">
								<div class="col-md-2">
							  		<label for="status_civil">Estado Civil:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<select class="form-select" name="status_civil" id="status_civil" required="required">
									    <option value="VIUVO">VIUVO</option>
									    <option value="VIUVA">VIUVA</option> <option value="VIUVO">SOLTEIRO</option>
									    <option value="VIUVA">SOLTEIRA</option>	<option value="VIUVO">CASADO</option>
									    <option value="VIUVA">CASADA</option>
									</select>
								</div>

								<div class="col-md-2">
							  		<label for="dt_civil">Dt:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control" placeholder="Nome Completo" data-error="Campo necessário"  required="required" name="dt_civil" id="dt_civil" type="date">
								</div>						
							</div>

							<div class="row">
								<div class="col-md-2">
							  		<label for="conjuge_civil">Conjuge:</label>
							  	</div>
							  	<div class="col-md-4 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="conjuge_civil" id="conjuge_civil" type="text">
								</div>
								<div class="col-md-1">
							  		<label for="cartorio_civil">Cartório:</label>
							  	</div>
							  	<div class="col-md-5 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="cartorio_civil" id="cartorio_civil" type="text">
								</div>
							</div>	
							

							<div class="row">
								<div class="col-md-2">
							  		<label for="certidao_civil">Certidão:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="certidao_civil" id="certidao_civil" type="text">
								</div>
								<div class="col-md-2">
							  		<label for="folha_civil">Folha:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="folha_civil" id="folha_civil" type="text">
								</div>

								<div class="col-md-2">
							  		<label for="livro_civil">Livro:</label>
							  	</div>
							  	<div class="col-md-2 form-group">
									<input class="form-control" data-error="Campo necessário"  required="required" name="livro_civil" id="livro_civil" type="text">
								</div>						
							</div>
							
						</div>
					
							<div class="row">
								<div class="col-md-12 text-right">
		                			<button class="btn btn-success btn-lg pull-right" type="submit">Finalizar!</button>
		                		</div>
		                	</div>
		            </div>
		        </div>
		    </div>
		    		<div class="row">
							<div class="col-md-12 text-right">
		                		<button class="btn btn-primary nextBtn btn-lg" type="button"  id="next-prd">Próximo</button>
		                	</div>
		                </div>
		</form>
	</div>
</div>


                
                

                </section>
                
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Adicione um evento de clique ao botão "Registrar óbito"
        var registrarObitoBtn = document.getElementById("registrar_obito");
        registrarObitoBtn.addEventListener("click", function (e) {
            e.preventDefault(); // Impede o comportamento padrão do link

            // Abre o modal
            var clienteObitoModal = document.getElementById("cliente_obito_modal");
            clienteObitoModal.style.display = "block";
        });
        var classobt = document.getElementById("modalcode");
        classobt.addEventListener("click", function(e){
            classobt.style.display = "block!important";
        });
       
var regiobt = document.getElementById("close-modal-obito");
regiobt.addEventListener("click", function (e) {
    e.preventDefault(); // Impede o comportamento padrão do link
    console.log("teste");
    // Fecha o modal
    var clienteObitoModal = document.getElementById("cliente_obito_modal");
    clienteObitoModal.style.display = "none!important";
});



    });
    
    
    var succesbtn = document.querySelector(".btn-success");
    var classobt = document.getElementById("next-prd");
let count = 2;
const maxSteps = 6; // Defina o número total de passos
function HideAllSteps() {
    // Ocultar todos os passos
    for (let i = 2; i <= maxSteps; i++) {
        var step = document.getElementById(`step-${i}`);
        if (step) {
            step.style.display = "none";
        }
        console.log(i)
    }
    
    
}
 HideAllSteps();
 
classobt.addEventListener("click", function(e) {
    var classstep = document.getElementById(`step-${count}`);
        var classstepOne = document.getElementById("step-1");
    

    if (classstep) {
        // Oculte todos os passos antes de exibir o próximo
        HideAllSteps();
        
        // Exiba o próximo passo
        classstep.style.display = "block";

        count++; // Incrementar contador para o próximo clique
        if (count>6){
            classobt.style.display="none"
        }
        if (count>2){
            classstepOne.style.display="none"
        }
        // Reinicie o contador se atingir o último passo
        if (count > maxSteps) {
            count = 1;
        }
    } else {
        console.error(`Element with ID "step-${count}" not found.`);
    }
});



    
    
    
    
    //script modal
    
    
    $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');



    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-secondary');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });


    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-secondary');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            atualcomerro = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent(),
            passoativo = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next(),
            curInputs = curStep.find("input[type='text'],input[type='url']");


		$('#obitoform').validate({
        	rules: {
            	falecido_check: {
                	required: true
            	},
            	numero_declaracao: {
                	required: true
            	},
            	data_obito: {
                	required: true
            	},
            	local_obito: {
                	required: true
            	},
            	hora_obito: {
                	required: true
            	},
            	hora_sepultamento: {
                	required: true
            	},
            	cemiterio: {
                	required: true
            	},
            	cidade_cemiterio: {
                	required: true
            	},
            	nome_declarante: {
                	required: true
            	},
            	cpf_declarante: {
	                required: true
    	        },
        	    cep_declarante: {
            	    required: true
            	},
            	endereco_declarante: {
            	    required: true
            	},
            	numero_declarante: {
            	    required: true
            	},
            	bairro_declarante: {
            	    required: true
            	},
            	cidade_declarante: {
            	    required: true
            	},
            	estado_declarante: {
            	    required: true
            	},
            	tel_cel_declarante: {
            	    required: true
            	},
            	nome_medico: {
            	    required: true
            	},
            	crm_medico: {
            	    required: true
            	},  
            	dt_assinatura: {
            	    required: true
            	},
            	telefone_medico: {
            	    required: true
            	},
            	causa_morte: {
            	    required: true
            	},
            	status_civil: {
            	    required: true
            	},            	            	
            	dt_civil: {
            	    required: true
            	},
            	conjuge_civil: {
            	    required: true
            	},            	
            	cartorio_civil: {
            	    required: true
            	},
            	certidao_civil: {
            	    required: true
            	},            	            	
            	folha_civil: {
            	    required: true
            	},
            	livro_civil: {
            	    required: true
            	},
        	},
        	onfocusout: function(element) {
            	this.element(element);
        	},
        	highlight: function(input) {
            	jQuery(input).addClass('error');
        	},
        	errorPlacement: function(error, element){},
        	// submitHandler: function(form) {
        	// 	console.log('envio de formulario');
        	// 	return false;
        	// }

	        submitHandler: function(form) {
	            var dadosformulario = jQuery( "#obitoform" ).serialize();
	                jQuery.ajax({
	                    url: 'z-ajax.php?action=cadastrar_obito',
	                    type: 'POST',
	                    dataType: 'json',
	                    cache:  'false',
	                    data: dadosformulario,
	                beforeSend: function(){
	                    jQuery('.formarea').slideUp();
	                    var htmlText = '<div class="retorno">' +
	                            '<img src="assets/images/ajax-loader.gif" /> ' +
	                          '<span id="newConfirmation"> Aguarde processando...</span></div>';
	                    $('.loadingform').append(htmlText);
	                },
	                success: function (obj){
	                    jQuery('.retorno').slideUp();
	                    //adiciona class para que se fechado o modal atualiza a pagina
	                    $('#modalcode').addClass('modal_back');
	                    $('div.modal-header button').addClass('modal_bt_back');
	                    var htmlconfirm = ' <div class="alert alert-success" role="alert"><strong>Tudo certo! </strong>Dados foram atualizados.</div>';
	                    $('.loadingform').html(htmlconfirm);
	                },
	                error: function (e){
	                    jQuery('.retorno').slideUp();
	                    var htmlconfirm = ' <div class="alert alert-danger" role="alert"><strong>Algo está errado! </strong>Verifique se tudo foi preenchido corretamente.</div>';                  
	                    $('.loadingform').html(htmlconfirm);                    
	                }
	              });
	            return false;
	          }

        });

    	
    	if ($('#obitoform').valid()){
        	console.log('validação ok');
            // do some stuff
            $('.indicadorstep').removeClass('corrigirdados');
            nextStepWizard.removeAttr('disabled').trigger('click');
            $(passoativo).addClass("passoatual");
        }
        else {
        	//alert('nao ok');
        	console.log('validação pendente');
			$(atualcomerro).addClass("corrigirdados");    		  
            //	$(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    });
    $('div.setup-panel div a.btn-primary').trigger('click');

  $(document).ready(function () {
    var currentStep = 1;

    // Function to show the current step
    function showStep(step) {
      $('.setup-content').hide();
      $('#step-' + step).show();
    }

    // Event handler for next button
    $('.nextBtn').on('click', function () {
      currentStep++;
      showStep(currentStep);

      // Disable/enable buttons based on the current step
      if (currentStep > 1) {
        $('.prevBtn').prop('disabled', false);
      }

      if (currentStep === 6) {
        $('.nextBtn').hide();
      } else {
        $('.nextBtn').show();
      }
    });

    // Event handler for previous button
    $('.prevBtn').on('click', function () {
      currentStep--;
      showStep(currentStep);

      // Disable/enable buttons based on the current step
      if (currentStep === 1) {
        $('.prevBtn').prop('disabled', true);
      }

      if (currentStep < 6) {
        $('.nextBtn').show();
      }
    });

    // Initialize by showing the first step
    showStep(currentStep);
  });







//definindo altura da area
var highest;
var first = 1;
$('.setup-content').each(function() {
   if(first == 1){
        highest = $(this);
        first = 0;
   }
   else {
        if(highest.actual( 'height' ) < $(this).actual( 'height' )) {
              highest = $(this);
        }
   }
  });
var altura = $( '#'+highest[0].id ).actual( 'height' );
$( ".bodystep" ).css( "height", altura+'px')


});	
</script>


<style>
    #cliente_obito_modal {
        display: none;
        height:auto;
        position:absolute;
        top:26%;
        background-color:white;
        padding:20px 20px 20px 20px;
        border-radius:10px;

        /* Adicione outros estilos necessários para o modal aqui */
    }
    /*#step-1{*/
    /*    display:flex;*/
    /*}*/
    /*#step-2,#step-3,#step-4,#step-5{*/
    /*    display:none;*/
    /*}*/

</style>
