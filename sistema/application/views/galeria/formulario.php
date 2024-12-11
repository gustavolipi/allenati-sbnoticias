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
                    <a href="<?= base_url('galeria') ?>">Galerias</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Galerias
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
                                    <div class="col-md-9">
                                        <input type="date"
                                               name="data"
                                               placeholder="Data"
                                               value="<?= @$registro->DATA ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="titulo"
                                               placeholder="Titulo"
                                               value="<?= @$registro->TITULO ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Categoria</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="categoria"
                                               placeholder="Categoria"
                                               value="<?= @$registro->CATEGORIA ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Coluna</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="coluna"
                                               placeholder="Coluna"
                                               value="<?= @$registro->COLUNA ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Descrição</label>
                                    <div class="col-md-9">
                                        <textarea name="descricao" class="form-control"
                                                  id="descricao"
                                                  placeholder="Descrição" cols="5"
                                                  rows="5"><?= @$registro->DESCRICAO ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Vídeo</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="video"
                                               placeholder="Url do Youtube"
                                               value="<?= @$registro->VIDEO ?>"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Autor</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="autor"
                                               placeholder="Autor"
                                               value="<?= @$registro->AUTOR ?>"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>

<?php
if (@$usuario_id == null) {
    ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Disponivel</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="disponibilidade" id="disponibilidade">
                                            <option value="1" <?= (@$registro->DISPONIBILIDADE == 1 ? 'selected' : null) ?>>
                                                Sim
                                            </option>
                                            <option value="0" <?= (@$registro->DISPONIBILIDADE == 0 ? 'selected' : null) ?>>
                                                Não
                                            </option>
                                        </select>
                                    </div>
                                </div>
<?php
}
?>                                
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?= base_url('galeria') ?>" class="btn red">
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
