<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
                    <a href="<?= base_url('politica') ?>">Notícias de Política</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Notícias de Politica
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
                                    <label class="control-label col-md-3">Data</label>
                                    <div class="col-md-4">
                                        <input type="date" name="data" placeholder="Data" value="<?= (@$registro->DATA) ? $registro->DATA : date('Y-m-d') ?>" class="form-control" required>
                                    </div>
                                    <label class="control-label col-md-1">Hora</label>
                                    <div class="col-md-2">
                                        <input type="text" name="hora" placeholder="Hora" value="<?= (@$registro->HORA) ? date('H:i', strtotime($registro->HORA)) : date('H:i') ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="titulo" placeholder="Titulo" value="<?= @$registro->TITULO ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Linha Fina</label>
                                    <div class="col-md-9">
                                        <textarea name="chamada" placeholder="Linha Fina" class="form-control"
                                            rows="2"><?= @$registro->CHAMADA ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Conteúdo</label>
                                    <div class="col-md-9">
                                        <textarea name="conteudo" placeholder="Conteúdo" class="form-control" id="summernote" rows="10"><?= @$registro->CONTEUDO ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Imagem</label>
                                    <div class="col-md-9">
                                        <?php
                                        if (@$registro->FOTO) {
                                        ?>
                                            <a href="<?= base_url('politica/acao/' . $registro->ID . '/excluir-foto') ?>">
                                                Excluir </a><br>
                                            <img src="<?= url_tikers . 'imagens/' . @$registro->FOTO ?>" width="100" alt="">
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="arquivo" placeholder="Selecione a Imagem Principal" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Legenda</label>
                                    <div class="col-md-9">
                                        <input type="text" name="legenda" placeholder="Legenda" value="<?= @$registro->LEGENDA ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Categoria</label>
                                    <div class="col-md-9">
                                        <input type="text" name="categoria" placeholder="Categoria" value="<?= @$registro->CATEGORIA ? @$registro->CATEGORIA : 'POLITICA' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Prioridade</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="prioridade" id="prioridade">
                                            <option value="">Selecione</option>
                                            <option value="1" <?= (@$registro->PRIORIDADE == 1 ? 'selected' : null) ?>>1</option>
                                            <option value="2" <?= (@$registro->PRIORIDADE == 2 ? 'selected' : null) ?>>2</option>
                                            <option value="3" <?= (@$registro->PRIORIDADE == 3 ? 'selected' : null) ?>>3</option>
                                            <option value="4" <?= (@$registro->PRIORIDADE == 4 ? 'selected' : null) ?>>4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?= base_url('politica') ?>" class="btn red">
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