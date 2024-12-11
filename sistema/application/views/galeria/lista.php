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
					Galerias
				</li>
			</ul>

		</div>


		<h3 class="page-title">
           Galerias
			<small>Todos os registros</small>
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
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box grey-cascade">
					<div class="portlet-title">
						<div class="caption">
							Listagem
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="row">
								<div class="col-md-3">
									<form method="get">
                                        <div class="input-group">
                                            <input type="text" name="palavra" class="form-control" placeholder="Filtrar..." value="<?= @$_GET['palavra'] ?>">
                                            <span class="input-group-btn">
                                                <button class="btn red" type="button"><span aria-hidden="true" class="icon-magnifier"></span></button>
                                            </span>
                                        </div>
                                    </form>
								</div>
								<div class="col-md-9">
									<div class="btn-group pull-right">
										<a href="<?= base_url('galeria/formulario') ?>" class="btn green">
											Novo registro <i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover dataTable " id="sample_1">
							<?php
							if (@$galeria) {
								?>
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
											<?= DataFormatar( $value->DATA, 'd/m/Y' ) ?>
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
								}
								?>
								</tbody>
								<?php
							} else {
								?>
								<tbody>
								<tr>
									<td>Nenhum registro encontrado.</td>
								</tr>
								</tbody>
								<?php
							}
							?>
						</table>

							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<div class="dataTables_paginate paging_bootstrap_extended"
											 id="sample_2_paginate">
											<div class="pagination-panel">
												Paginas
												<?php
												if($atual_paginas > 1){
													$pagina = $atual_paginas - 1;
												?>
												<a href="<?= base_url() . 'galeria/index/' . $pagina ?>" class="btn btn-sm default prev "><i class="fa fa-angle-left"></i></a>
													<?php
												}
												?>

												<input type="number"
													   class="pagination-panel-input form-control input-sm input-inline "

													   minlength="1"
													   onchange="window.location='<?= base_url('galeria/index/') ?>/' + this.value"
													   value="<?= $atual_paginas ?>"
													   style="text-align:center; margin: 0 5px;">


												<?php
												$pagina = $atual_paginas + 1;
												?>
													<a href="<?= base_url() . 'galeria/index/' . $pagina ?>"
													   class="btn btn-sm default next"><i class="fa fa-angle-right"></i></a>

											</div>
										</div>
									</div>
								</div>
							</div>

					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>

		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->