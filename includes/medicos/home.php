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
                                <h3>Gestão de Médicos</h3>
                                </div>
                                <div class="col-lg-3 d-grid"  style="padding-right: 1.5em;">
                                    <a href="#" class="btn btn-primary open_modal" id="novo_medico" mtype="medico"><i class="bi_header fas fa-users"></i> &nbsp;&nbsp; Novo médico </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tabelamedicos">
                                <thead>
                                    <tr>
                                        <th>Cód</th>
                                        <th>Especialidade</th>
                                        <th>Nome</th>
                                        <th>Tel.</th>
                                        <th>Cel.</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $medico_parciais = 'SELECT * FROM medicos WHERE status="1" ORDER by nome ASC';
                                    $resultados_medico_parciais = $database->get_results($medico_parciais);
                                    foreach ($resultados_medico_parciais as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['id'];?></td>
                                        <td><?php echo $value['especialidade'];?></td>
                                        <td><?php echo $value['nome'];?></td>
                                        <td><?php echo $value['telefone'];?></td>
                                        <td><?php echo $value['celular'];?></td>
                                        <td>
                                            <?php if($value['status'] == "1"){?>
                                            <span class="badge bg-primary">Ativo</span>
                                            <?php }else{?>
                                                <span class="badge bg-secondary">Inativo</span>
                                            <?php }?>
                                        </td>
                                        <td>

                                        <ul class="list-inline m-0 d-flex">
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-icon action-icon open_modal" id="<?php echo $value['id'];?>" mtype="medico_editar">
                                                    <span class="fonticon-wrap">
                                                        <i class="fab fa-wpforms"></i>
                                                    </span>
                                                    Ficha
                                                </button>
                                            </li>
                                            <li class="list-inline-item ">
                                                <button type="button" class="btn btn-icon action-icon open_modal" id="<?php echo $value['id'];?>" mtype="medico_excluir">
                                                    <span class="fonticon-wrap d-inline">
                                                       <i class="far fa-trash-alt"></i>
                                                    </span>
                                                    Excluir
                                                </button>
                                            </li>
                                        </ul>

                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>





<!--login form Modal -->
<div class="modal fade text-left w-100" id="modalcode" tabindex="-1" role="dialog" aria-labelledby="modalpadrao" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title" id="myModalLabel16">Modal</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>