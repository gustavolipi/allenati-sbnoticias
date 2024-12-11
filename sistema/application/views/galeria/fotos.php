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
                    <a href="<?php echo base_url('galeria') ?>">Galerias</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Fotos da Galeria</li>
            </ul>

        </div>


        <h3 class="page-title">
            Fotos da Galeria
            <small>Adicionar</small>
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


<div class="modal fade" id="legendaModal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Legenda</h4>
            </div>
            <form class="form-horizontal form-row-seperated" method="post">
                <input type="hidden"
                       name="id"
                       value="">
                <input type="hidden"
                       name="galeria"
                       value="">
                <div class="modal-body">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Legenda</label>
                                <div class="col-md-9">
                                    <input type="text"
                                           name="legenda"
                                           placeholder="Legenda"
                                           value=""
                                           class="form-control"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- END FORM-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn blue">Salvar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

