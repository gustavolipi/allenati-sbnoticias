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
                    <a href="<?= base_url('publicidade') ?>">Publicidade</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Publicidade
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
                                    <label class="control-label col-md-3">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="titulo"
                                               placeholder="Titulo"
                                               value="<?= @$registro->titulo ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tipo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="">Selecione</option>
                                            <option value="1" <?= (@$registro->tipo == 1 ? 'selected' : null) ?>>Banner topo grande (955x140px)</option>
                                            <option value="2" <?= (@$registro->tipo == 2 ? 'selected' : null) ?>>Banner topo pequeno (305x140px)</option>
                                            <option value="3" <?= (@$registro->tipo == 3 ? 'selected' : null) ?>>Banner lateral (300x190px)</option>
                                            <option value="4" <?= (@$registro->tipo == 4 ? 'selected' : null) ?>>Capa Anuncio Publicitário Galeria (240x320px)</option>
                                            <option value="5" <?= (@$registro->tipo == 5 ? 'selected' : null) ?>>Capa Anuncio Publicitário Rodape (240x530px)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Local</label>
                                    <div class="col-md-9">
                                        <input type="checkbox"
                                               name="capa"
                                               value="1"
                                               <?= (@$registro->capa == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina inicial

                                        <input type="checkbox"
                                               name="interna"
                                               value="1"
                                               <?= (@$registro->interna == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina interna

                                        <input type="checkbox"
                                               name="esporte"
                                               value="1"
                                               <?= (@$registro->esporte == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina esporte

                                        <input type="checkbox"
                                               name="noticia"
                                               value="1"
                                               <?= (@$registro->noticia == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina notícia

                                        <input type="checkbox"
                                               name="classificados"
                                               value="1"
                                               <?= (@$registro->classificados == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina Classificado

                                        <input type="checkbox"
                                               name="tv"
                                               value="1"
                                               <?= (@$registro->tv == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina Tv

                                        <input type="checkbox"
                                               name="podcasts"
                                               value="1"
                                               <?= (@$registro->podcasts == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina Podcast

                                        <input type="checkbox"
                                               name="revistas"
                                               value="1"
                                               <?= (@$registro->revistas == 1 ? 'checked' : null) ?>
                                               class="form-control"> Pagina Revista
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Inicio</label>
                                    <div class="col-md-9">
                                        <input type="date"
                                               name="data_inicio"
                                               placeholder="Data"
                                               value="<?= (@$registro->data_inicio) ? $registro->data_inicio : date('Y-m-d') ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Fim</label>
                                    <div class="col-md-9">
                                        <input type="date"
                                               name="data_fim"
                                               placeholder="Data"
                                               value="<?= (@$registro->data_fim) ? $registro->data_fim : date('Y-m-d') ?>"
                                               class="form-control"
                                               >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Link</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="link"
                                               placeholder="Link"
                                               value="<?= @$registro->link ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Abrir em </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="target" id="target">
                                            <option value="">Selecione</option>
                                            <option value="_blank" <?= (@$registro->target == '_blank' ? 'selected' : null) ?>>Nova janela</option>
                                            <option value="_self" <?= (@$registro->target == '_self' ? 'selected' : null) ?>>Mesma janela</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Arquivo</label>
                                    <div class="col-md-9">
                                        <?php
                                        if (@$registro->arquivo) {
                                            ?>
                                            <a href="<?= base_url('publicidade/acao/' . $registro->id . '/excluir-foto') ?>">
                                                Excluir </a><br>
                                            <img src="<?= url_tikers . 'publicidade/' . @$registro->arquivo ?>"
                                                 width="100" alt="">
                                            <?php
                                        }
                                        ?>
                                        <input type="file"
                                               name="arquivo"
                                               placeholder="Selecione a Imagem do banner"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Código
                                        <br>
                                        <small>Para contar os clicks usando essa opção, use o link gerado na listagem</small>
                                    </label>
                                    <div class="col-md-9">
										<textarea name="codigo"
                                                  placeholder="Código"
                                                  class="form-control"><?= @$registro->codigo ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?= base_url('publicidade') ?>" class="btn red">
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
