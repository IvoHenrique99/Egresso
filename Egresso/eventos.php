<?php  require_once("cabecalho.php"); //Página que lista e filtrar as respostas dos Egressos.
require_once("banco/conexao.php"); //obs: depois temos que trocar o nome do arquivo
require_once("banco/banco-aluno.php");
require_once("banco/banco-curso.php");
require_once("banco/mostrar-alerta.php");
require_once("banco/funcoes.1.php");
require_once("banco/funcoes.2.php");
error_reporting("E_NOTICE");

mostrarAlerta("success");

?>

    <!-- END HEADER DESKTOP-->

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6">
                        <!-- USER DATA-->

                    </div>
                    <!-- END USER DATA-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Feedback dos Egressos</h3>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>

        <div class="col-8 col-md-4">
            <form class="form-header" action="eventos.php" method="GET">
                <select name="trabalha" id="select" class="form-control">
                    <option disabled selected><small>Filtrar</small></option>
                    <option value="1"> SIM </option>
                    <option value="0||trabalha=0"> NÃO </option>
                    <option value="1||trabalha=0"> INDIFERENTE </option>

                </select>

                <button class="au-btn--submit" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </form>
        </div>

        <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th class="text-center">RA</th>
                                <th class="text-center">NOME</th>

                                <th class="text-center">TRABALHA</th>
                                <th class="text-center">EMPRESA</th>
                                <th class="text-center">AREA</th>
                                <th class="text-center">CARGO</th>
                                <th class="text-center">DATA</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                          $respostas = listarTrabalha($conexao);  
                                          $contar = count($respostas); ?>
                                <p class="text text-left">
                                    <?php echo $contar ?> Registros </p>
                                <?php    
                                                $simOuNao = [ 
                                                    1 => "SIM",
                                                    0 => "NÃO"
                                                ];

                                                foreach ($respostas as $resposta) {
                                        ?>
                                    <tr>
                                        <td class="process text-center">
                                            <?= $resposta['RA'] ?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $resposta['nome'] ?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $simOuNao[$resposta['trabalha']] ?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $resposta['empresa'] == 'NULL' ? "-" : $resposta['empresa'] ?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $resposta['area'] == 'NULL' ? "-" : $resposta['area']?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $resposta['cargo'] == 'NULL' ? "-" : $resposta['cargo'] ?>
                                        </td>
                                        <td class="process text-center">
                                            <?= $resposta['date'] ?>
                                        </td>

                                    </tr>
                                    <?php } ?>

                        </tbody>
                    </table>
                </div>
                <?php 
                                    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                                    $valor_pesquisar = "&?trabalha=0";
                                    $pagina_anterior = $pagina - 1;
                                    $pagina_posterior = $pagina + 1;

                                ?>
                    <nav aria-label="pagination-lg" class="text-center">
                        <?php
                                        if ($pagina_anterior != 0) { ?>
                            <a class="btn btn-primary" href="eventos.php?pagina=<?= $pagina_anterior; ?><?= $valor_pesquisar ?><?= $ano_id ?>" aria-label="Previous">
                                <span aria-hidden="true">Voltar</span>
                            </a>
                            <?php } else { ?>
                                <span aria-hidden="true"></span>
                                <?php }  ?>

                                    <?php 

                                     if ($quantidade_paginas = paginarTrabalha($conexao));

                                        for ($i = 1; $i < $quantidade_paginas + 1; $i++) {

                                            if($pagina == $i) { ?>

                                        <a class="btn btn-danger" href="eventos.php?trabalha=<?= $i ?><?= $valor_pesquisar ?>">
                                            <?= $i ?>
                                        </a>
                                        </li>
                                        <?php }  else { ?>

                                            <a class="btn btn-secondary" href="eventos.php?trabalha=<?= $i ?><?= $valor_pesquisar ?>">
                                                <?= $i ?>
                                            </a>
                                            </li>
                                            <?php }
                                         } ?>

                                                <?php
                                        if($pagina_posterior <= $quantidade_paginas){ ?>
                                                    <a class="btn btn-primary" href="eventos.php?pagina=<?=  $pagina_posterior; ?>" aria-label="Previous">
                                                        <span aria-hidden="true">Proxima</span>
                                                    </a>
                                                    <?php } else { ?>
                                                        <span aria-hidden="true"></span>
                                                        <?php }  ?>
                    </nav>

                    <!-- END DATA TABLE-->
            </div>
        </div>
        <?php require_once("rodape.php"); ?>