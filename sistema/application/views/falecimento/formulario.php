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
                    <a href="<?= base_url() ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <i class="icon-briefcase"></i>
                    <a href="<?= base_url('falecimento') ?>">Nota de Falecimento</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Nota de Falecimento
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
                            <span class="caption-subject font-green-haze bold uppercase">Formulário de Cadastro</span>
                            <span class="caption-helper"> preencha os campos abaixo</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nome</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="nome"
                                               placeholder="Nome"
                                               value="<?= @$registro->NOME ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Dia Falecimento</label>
                                    <div class="col-md-9">
                                        <input type="date"
                                               name="d_falecimento"
                                               placeholder="Data"
                                               value="<?= (@$registro->D_FALECIMENTO ? @$registro->D_FALECIMENTO : date('Y-m-d')) ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Hora Falecimento</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="h_falecimento"
                                               placeholder="Data"
                                               value="<?= (@$registro->H_FALECIMENTO ? @$registro->H_FALECIMENTO : date('H:i:s')) ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Velório</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="velorio"
                                               placeholder="Velório"
                                               value="<?= @$registro->VELORIO ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Dia Sepultamento</label>
                                    <div class="col-md-9">
                                        <input type="date"
                                               name="d_sepultamento"
                                               placeholder="Data"
                                               value="<?= (@$registro->D_SEPULTAMENTO ? @$registro->D_SEPULTAMENTO : date('Y-m-d')) ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Hora Sepultamento</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="h_sepultamento"
                                               placeholder="Data"
                                               value="<?= (@$registro->H_SEPULTAMENTO ? @$registro->H_SEPULTAMENTO : date('H:i:s')) ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Cemitério</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="cemiterio"
                                               placeholder="Cemitério"
                                               value="<?= @$registro->CEMITERIO ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Fonte</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="fonte"
                                               placeholder="Fonte"
                                               value="<?= @$registro->FONTE?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mais informções</label>
                                    <div class="col-md-9">
                                        <textarea name="informacoes"
                                               placeholder="Mais informações"
                                                  class="form-control"><?= @$registro->INFORMACOES?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Imagem</label>
                                    <div class="col-md-9">
                                        <?php
                                        if (@$registro->FOTO) {
                                        ?>
                                            <a href="<?= base_url('falecimento/acao/' . $registro->ID . '/excluir-foto') ?>">
                                                Excluir </a><br>
                                            <img src="<?= url_tikers . 'imagens/' . @$registro->FOTO ?>" width="100" alt="">
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="arquivo" placeholder="Selecione a Imagem Principal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?= base_url('falecimento') ?>" class="btn red">
                                            <i class="fa fa-ban"></i> Cancelar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>

            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
