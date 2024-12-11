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
                    <a href="<?= base_url('classificado') ?>">Classificados</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>

        <h3 class="page-title">
            Classificado
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
                                    <label class="control-label col-md-3">Plano</label>
                                    <div class="col-md-9">
                                        <select class="form-control combo-plano" name="plano" id="plano" required>
                                            <option value="" disabled selected>Selecione um plano</option>
                                            <option value="ouro"
                                                <?= (@$registro->PLANO == 'ouro' ? 'selected' : NULL) ?>>
                                                Ouro
                                            </option>
                                            <option value="prata"
                                                <?= (@$registro->PLANO == 'prata' ? 'selected' : NULL) ?>>
                                                Prata
                                            </option>
                                            <option value="bronze"
                                                <?= (@$registro->PLANO == 'bronze' ? 'selected' : NULL) ?>>
                                                Bronze
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="categoria_id" id="categoria_id">
                                            <?php
                                            if (@$categorias) {
                                                foreach ($categorias as $item => $value) {
                                            ?>
                                            <option value="<?= $value->id ?>"
                                                <?= (@$value->id == @$registro->CATEGORIA_ID ? 'selected' : NULL) ?>>
                                                <?= $value->titulo ?>
                                            </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="titulo" placeholder="Titulo"
                                            value="<?= @$registro->TITULO ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">E-mail</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" placeholder="E-mail"
                                            value="<?= @$registro->EMAIL ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Telefone</label>
                                    <div class="col-md-9">
                                        <input type="text" name="telefones" placeholder="Telefone"
                                            value="<?= @$registro->TELEFONES ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Descrição</label>
                                    <div class="col-md-9">
                                        <textarea name="descricao" id="descricao" class="form-control"
                                            placeholder="Descrição"><?= @$registro->DESCRICAO ?></textarea>
                                    </div>
                                </div>
                                <div id="sociais-ouro" style="display: <?= @$registro->PLANO == 'ouro' ? 'block' : 'none' ?>;">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">WhatsApp</label>
                                        <div class="col-md-9">
                                            <input type="text" name="whatsapp" placeholder="WhatsApp"
                                                value="<?= @$registro->WHATSAPP ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Facebook</label>
                                        <div class="col-md-9">
                                            <input type="text" name="facebook" placeholder="Facebook"
                                                value="<?= @$registro->FACEBOOK ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Instagram</label>
                                        <div class="col-md-9">
                                            <input type="text" name="instagram" placeholder="Instagram"
                                                value="<?= @$registro->INSTAGRAM ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="boxLogo" style="display: <?= @$registro->PLANO == 'ouro' ? 'block' : 'none' ?>;">
                                    <label class="control-label col-md-3">Logo</label>
                                    <div class="col-md-9">
                                        <?php
                                        if (@$registro->ARQUIVO) {
                                            $imagem = url_tikers . 'classificados/' . @$registro->ARQUIVO;
                                        ?>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('classificado/acao/' . $registro->ID . '/excluir-logo') ?>"
                                                class="btn btn-secondary">Excluir</a>
                                            <button type="button" class="btn btn-secondary cropImage"
                                                data-image="<?= $imagem ?>" data-target="#myModal">Editar</button>
                                        </div>

                                        <br>

                                        <img src="<?= $imagem . '?v=' . date('YmdHis') ?>" width="100" alt="">
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="arquivo" placeholder="Selecione o logo"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Início</label>
                                    <div class="col-md-9">
                                        <input type="date" name="datainicio" placeholder="Data Início"
                                            value="<?= (@$registro->DATAINICIO ? $registro->DATAINICIO : date('Y-m-d')) ?>"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Fim</label>
                                    <div class="col-md-9">
                                        <input type="date" name="datafim" placeholder="Data Fim"
                                            value="<?= (@$registro->DATAFIM ? $registro->DATAFIM : date('Y-m-d')) ?>"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Ativo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="disponivel" id="disponivel">
                                            <option value="1" <?= (@$registro->DISPONIVEL == 1 ? 'selected' : null) ?>>
                                                Sim
                                            </option>
                                            <option value="0" <?= (@$registro->DISPONIVEL == 0 ? 'selected' : null) ?>>
                                                Não
                                            </option>
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
                                        <a href="<?= base_url('classificado') ?>" class="btn red">
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