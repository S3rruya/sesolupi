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
                                    Gestão de Clientes
                                </h3>
                                </div>
                                <div class="col-lg-3 d-grid"  style="padding-right: 1.5em;">
                                    <a href="#" class="btn btn-primary open_modal" id="novo_cliente" mtype="cliente"><i class="bi_header fas fa-users"></i> &nbsp;&nbsp; Novo cliente </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="printSection table table-striped" id="tabelaclientes">
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

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>


<!--login form Modal -->
    <div class="modal fade text-left w-100" id="modalcode" tabindex="-1" role="dialog" aria-labelledby="modalpadrao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title" id="myModalLabel16">Modal</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"><i data-feather="x"></i></button>
                </div>

                <div class="modal-body"></div>


                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button id="btnPrint" type="button" printarea="" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </div>
        </div>
    </div>



