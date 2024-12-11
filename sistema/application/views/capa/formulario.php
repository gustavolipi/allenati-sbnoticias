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
				<li>Destaque da Capa</li>
			</ul>

		</div>


		<h3 class="page-title">
            Destaque da Capa
			<small>Configurar</small>
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
                                    <label class="control-label col-md-3">Colunas</label>
                                    <div class="col-md-2">
                                        <select name="colunas" id="colunas" class="form-control" data-colunas="<?= @$capa->colunas ?>">
                                            <option value="1" <?= (@$capa->colunas == 1 ? 'selected' : null) ?>>1 Coluna</option>
                                            <option value="2" <?= (@$capa->colunas == 2 ? 'selected' : null) ?>>2 Colunas</option>
                                            <option value="3" <?= (@$capa->colunas == 3 ? 'selected' : null) ?>>3 Colunas</option>
                                            <option value="4" <?= (@$capa->colunas == 4 ? 'selected' : null) ?>>4 Colunas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?php echo base_url('capa/formulario/1') ?>" class="btn red">
                                            <i class="fa fa-ban"></i> Cancelar
                                        </a>
                                    </div>
                                </div>
							</div>
							<div class="form-actions">
								<div class="row">
                                    <label class="col-md-12">Preview</label>
								</div>
								<div class="row">
                                    <div class="col-md-12">
                                        <div id="load_preview"></div>
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
