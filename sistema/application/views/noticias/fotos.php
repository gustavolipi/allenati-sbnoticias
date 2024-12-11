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
                    <a href="<?php echo base_url() ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <i class="icon-briefcase"></i>
                    <a href="<?php echo base_url('infraestrutura') ?>">Infraestrutura</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Fotos da Infraestrutura</li>
            </ul>

        </div>


        <h3 class="page-title">
            Fotos da Infraestrutura
            <small>Adicionar Fotos</small>
        </h3>

        <?php
        if (@$msg_retorno) {
            echo @$msg_retorno;
        }
        ?>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->

        <div class="row">

            <div class="col-md-12">

                <div class="portlet light bordered form-fit">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">Cadastro de Fotos</span>
                            <span class="caption-helper"> </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <div class="form-actions">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Observações de Envio</h3>
                                    </div>
                                    <div class="panel-body">
                                        <ul>
                                            <li>
                                                Peso máximo da imagem <strong>2 MB</strong>
                                            </li>
                                            <li>
                                                Formato recomendado <strong>1024x768 PX</strong>
                                            </li>
                                            <li>
                                                Formatos aceitos <strong>JPG, GIF</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <br>

                                <div id="formulario_fotos">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="multipleupload" class="btn btn-danger" >
                                                Enviar imagens da galeria
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row" id="fotos_enviadas">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END FORM-->
                    </div>
                </div>

            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
