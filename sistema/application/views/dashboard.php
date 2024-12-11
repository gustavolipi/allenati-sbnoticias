<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    Dashboard
                </li>
            </ul>
        </div>

        <h3 class="page-title">
            Dashboard
            <small>Painel Administrativo</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->

        <?php
        if (@$galeria) {
        ?>

        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption">
                            Galeria Aguardando Liberação
                        </div>
                    </div>
                    <div class="portlet-body">
                        
                        <table class="table table-striped table-bordered table-hover dataTable " id="sample_1">

                            <thead>
                                <tr>
                                    <th>
                                        Data
                                    </th>
                                    <th>
                                        Titulo
                                    </th>
                                    <th>
                                        Categoria
                                    </th>
                                    <th>
                                        Coluna
                                    </th>
                                    <th>
                                        Autor
                                    </th>
                                    <th>
                                        Publicada
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach (@$galeria as $item => $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?= DataFormatar($value->DATA, 'd/m/Y') ?>
                                        </td>
                                        <td>
                                            <?= $value->TITULO ?>
                                        </td>
                                        <td>
                                            <?= $value->CATEGORIA ?>
                                        </td>
                                        <td>
                                            <?= $value->COLUNA ?>
                                        </td>
                                        <td>
                                            <?= $value->AUTOR ?>
                                        </td>
                                        <td>
                                            <?= $value->DISPONIBILIDADE == '1' ? 'Sim' : 'Não' ?>
                                        </td>
                                        <td>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-sm btn-warning dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    Ação <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="<?= base_url('galeria/formulario/' . $value->ID) ?>">
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('galeria/fotos/' . $value->ID) ?>">
                                                            Fotos
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:executar('<?= base_url('galeria/acao/' . $value->ID . '/excluir') ?>');">
                                                            Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                } ?>
                            </tbody>

                        </table>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
        <!-- END PAGE CONTENT-->

        <?php
        }
        ?>
    </div>
</div>
<!-- END CONTENT -->
