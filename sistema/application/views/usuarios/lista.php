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
                    Usuários
                </li>
            </ul>

        </div>


        <h3 class="page-title">
            Usuários
            <small>Todos os Usuários</small>
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
                            Listagem de Usuários
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    if($login_tipo == "M") {
                                        ?>
                                        <div class="btn-group pull-right">
                                            <a href="<?php echo base_url('usuarios/formulario') ?>" class="btn green">
                                                Novo Usuário <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTable " id="sample_1">
                            <?php
                            if ($usuarios) {
                                ?>
                                <thead>
                                <tr>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        E-mail
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($usuarios as $item => $value) {

                                    ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php
                                            if (isset($value->nome)) {
                                                echo $value->nome;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($value->email)) {
                                                echo $value->email;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($value->ativo)) {
                                                if($value->ativo == "1"){
                                                    echo "Ativo";
                                                }else{
                                                    echo "Inativo";
                                                }
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-sm btn-warning dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    Ação <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="<?php echo base_url('usuarios/formulario/' . $value->id) ?>">
                                                            Editar
                                                        </a>
                                                    </li>
                                                        <li>
                                                            <a href="javascript:executar('<?php echo base_url('usuarios/acao/' . $value->id . '/excluir') ?>');">
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

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->