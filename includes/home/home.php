<?php
/* NIVEL DE ACESSO */
/* level 90 */
/* */
/* NIVEL 90 = DONO DA FRANQUIA TEM ACESSO A TODOS OS ELEMENTOS */
/* NIVEL 70 = ACESSO LEVEMENTE LIMITADO -  PEQUENAS RESTRIÇÕES */
/* NIVEL 50 = ACESSO LIMITADO - FUNCIONARIO QUE APENAS PODE VER*/
/* NIVEL 30 = AINDA NÃO DEFINIDO */

$database = new DB();



//CLIENTES MENSAIS
$clientes_mensais = "SELECT clientes.id FROM clientes WHERE (clientes.tipo ='M' AND  clientes.status ='1') ";
$resultados_clientes_mensais = $database->num_rows($clientes_mensais);


//CLIENTES ANUAIS
$clientes_anuais = "SELECT clientes.id FROM clientes WHERE (clientes.tipo ='A' AND  clientes.status ='1') ";
$resultados_clientes_anuais = $database->num_rows($clientes_anuais);

//MEDICOS
$medicos = "SELECT medicos.id FROM medicos WHERE medicos.status ='1' ";
$resultados_medicos = $database->num_rows($medicos);



?>

            <div class="page-heading">
                <h3>Resumo do sistema</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="bi_header fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Clientes Mensais</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $resultados_clientes_mensais;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            


                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="bi_header fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Clientes Anuais</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $resultados_clientes_anuais;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="bi_header fas fa-user-md"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Médicos</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $resultados_medicos;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Cadastros por mês</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="<?php echo get_gravatar($_SESSION['fran_email']);?>" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">Bem vindo:</h5>
                                        <h6 class="text-muted mb-0"><?php echo $_SESSION['fran_nome'];

                                        // echo "<pre>";
                                        // print_r($_COOKIE);
                                        // echo "</pre>";

                                        // echo "<pre>";
                                        // print_r($_SESSION);
                                        // echo "</pre>";

                                    ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Últimos cadastros</h4>
                            </div>
                            <div class="card-content pb-4">
                                <?php 
                                    $ultimos_clientes = 'SELECT id, nome, tipo, tel_cel FROM clientes ORDER by dt_adesao DESC LIMIT 4';
                                    $resultados_ultimos_clientes = $database->get_results($ultimos_clientes);

                                foreach ($resultados_ultimos_clientes as $key => $value) {
                                  //  print_r($value['nome']);
                                ?>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="col-2 avatar avatar-lg tipocliente">
                                        <?php echo $value['tipo'];?>
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="col-10 mb-1 nomecli"><?php echo $value['nome'];?></h5>
                                        <h6 class="text-muted mb-0"><?php echo $value['tel_cel'];?></h6>
                                    </div>
                                </div>
                                <?php } ?>


                            </div>
                        </div>

                    </div>
                </section>
            </div>


