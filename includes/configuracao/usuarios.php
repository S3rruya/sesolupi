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
                                   <h3> Gestão de usuários</h3>
                                </div>
                                <div class="col-lg-3 d-grid"  style="padding-right: 1.5em;">
                                    <a href="#" class="btn btn-primary open_modal" id="novo_usuario" mtype="usuario"><i class="bi_header fas fa-users"></i> &nbsp;&nbsp; Novo usuário </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tabelausuarios">
                                <thead>
                                    <tr>
                                        <th>Cód</th>                                        
                                        <th>Nome</th>
                                        <th>Tel.</th>
                                        <th>Cel.</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $clientes_parciais = 'SELECT * FROM usuarios ORDER by nome ASC';
                                    $resultados_clientes_parciais = $database->get_results($clientes_parciais);
                                    foreach ($resultados_clientes_parciais as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['id'];?></td>                                        
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
                                        <td><a href="#" class="open_modal" id="<?php echo $value['id'];?>" mtype="usuario_editar"><span class="badge bg-light-primary"><i class="fab fa-wpforms"></i> Ficha</span></a>
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