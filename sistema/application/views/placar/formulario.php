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
                    <a href="<?= base_url('placar') ?>">Placar</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Placar
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
                                    <label class="control-label col-md-3">Nome do campeonato</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="nome_campeonato"
                                               placeholder="Nome do campeonato"
                                               value="<?= @$registro->nome_campeonato ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status do Jogo</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="status_jogo"
                                               placeholder="Status do Jogo"
                                               value="<?= @$registro->status_jogo ?>"
                                               class="form-control"
                                               required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Link da transmissão</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="link_transmissao"
                                               placeholder="Link da transmissão"
                                               value="<?= @$registro->link_transmissao ?>"
                                               class="form-control"
                                               >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Situação</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Selecione</option>
                                            <option value="ativo" <?= (@$registro->status == 'ativo' ? 'selected' : NULL) ?>>
                                                Ativo
                                            </option>
                                            <option value="inativo" <?= (@$registro->status == 'inativo' ? 'selected' : NULL) ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Brsão Donos da Casa</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                if (@$registro->brasao_dc) {
                                                    ?>
                                                    <a href="<?= base_url('placar/acao/' . $registro->id . '/excluir-foto1') ?>">
                                                        Excluir </a><br>
                                                    <img src="<?= url_tikers . 'brasao/' . @$registro->brasao_dc ?>"
                                                         width="100" alt="">
                                                    <?php
                                                }
                                                ?>
                                                <input type="file"
                                                       name="arquivo_dono"
                                                       placeholder="Selecione a Imagem"
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-12">
                                                <input type="text" name="sigla_dc"
                                                       placeholder="Sigla Donos da Casa"
                                                       value="<?= @$registro->sigla_dc ?>"
                                                       class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Brsão Visitantes</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                if (@$registro->brasao_vt) {
                                                    ?>
                                                    <a href="<?= base_url('placar/acao/' . $registro->id . '/excluir-foto2') ?>">
                                                        Excluir </a><br>
                                                    <img src="<?= url_tikers . 'brasao/' . @$registro->brasao_vt ?>"
                                                         width="100" alt="">
                                                    <?php
                                                }
                                                ?>
                                                <input type="file"
                                                       name="arquivo_visitante"
                                                       placeholder="Selecione a Imagem"
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text"
                                                       name="sigla_vt"
                                                       placeholder="Sigla Visitante"
                                                       value="<?= @$registro->sigla_vt ?>"
                                                       class="form-control" required="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Placar</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text"
                                                       name="gol_dc"
                                                       placeholder="Gol Donos"
                                                       value="<?= (@$registro->gol_dc ? @$registro->gol_dc : '0') ?>"
                                                       class="form-control" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text"
                                                       name="gol_vt"
                                                       placeholder="Gol Visitante"
                                                       value="<?= (@$registro->gol_vt ? @$registro->gol_vt : '0') ?>"
                                                       class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?= base_url('placar') ?>" class="btn red">
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
