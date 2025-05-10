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
                    <a href="<?php echo base_url('usuarios') ?>">Usuários</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>Formulário</li>
            </ul>

        </div>


        <h3 class="page-title">
            Usuários
            <small>Formulário de Cadastro</small>
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
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form class="form-horizontal form-row-seperated" method="post" name="frmEvento">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">E-mail</label>
                                    <div class="col-md-9">
                                        <input type="email"
                                               name="email"
                                               placeholder="E-mail"
                                               value="<?php echo @$usuario->email ?>"
                                               class="form-control "
                                               required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Senha</label>
                                    <div class="col-md-9">
                                        <input type="password"
                                               name="senha"
                                               placeholder="Defina uma senha"
                                               value=""
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Nome</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="nome"
                                               placeholder="Nome do Responsável"
                                               value="<?php echo @$usuario->nome ?>"
                                               class="form-control "
                                               required>
                                    </div>
                                </div>
                                <?php
                                if($this->session->userdata('login')['nivel'] == 'M') {
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Ativo</label>
                                        <div class="col-md-4">
                                            <?php
                                            echo form_dropdown("ativo", $cmp_ativo,
                                                @$usuario->ativo,
                                                'class="form-control" required');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tipo</label>
                                        <div class="col-md-4">
                                            <?php
                                            echo form_dropdown("tipo", $cmp_tipo,
                                                @$usuario->nivel,
                                                'class="form-control" required');
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9 " >
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                        <a href="<?php echo base_url('usuarios') ?>" class="btn red">
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

            <?php
            if ($id) {
                ?>

                <div class="col-md-3">

                    <?php
                    if (isset($visitas)) {
                        ?>

                        <div class=" light" style="padding: 0px !important; background-color: #fff">

                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-default green-haze">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a class="badge badge-default pull-right bold" style="display: none">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <div class="list-head-title-container">
                                                    <h3 class="list-title uppercase sbold">Próxima Visitas</h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-12" style="display: none">
                                                <div class="list-head-summary-container">
                                                    <div class="list-pending">
                                                        <div class="badge badge-default list-count">3</div>
                                                        <div class="list-label">Aguardando</div>

                                                        <div class="list-count badge badge-default last">2</div>
                                                        <div class="list-label">Completas</div>

                                                        <div class="list-count badge badge-default last">2</div>
                                                        <div class="list-label">Canceladas</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-list-container list-default"
                                         style="overflow: auto; max-height: 263px;">
                                        <ul>
                                            <?php
                                            foreach ($visitas as $item => $value) {
                                                ?>
                                                <li class="mt-list-item">
                                                    <?php
                                                    switch ($value->status) {
                                                        case "1":
                                                            ?>
                                                            <div class="list-icon-container">
                                                                <a data-toggle="modal"
                                                                   href="#modal_retorno_visita"
                                                                   data-id="<?php echo $value->id ?>"
                                                                   name="abrirModalVisita">
                                                                    <i class="icon-check"></i>
                                                                </a>
                                                            </div>
                                                            <?php
                                                            break;
                                                        case "2":
                                                            ?>
                                                            <div
                                                                class="list-icon-container font-blue">
                                                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                            </div>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>

                                                    <div class="list-item-content">
                                                        <h3 class="uppercase bold">
                                                            <?php echo DataMySQLtoBR($value->data) ?>
                                                        </h3>
                                                        <p><?php echo $value->descricao ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <?php
                    }
                    ?>

                    <?php
                    if (isset($retornos)) {
                        ?>

                        <div class=" light" style="padding: 0px !important; background-color: #fff">

                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-default green-haze">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a class="badge badge-default pull-right bold" style="display: none">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <div class="list-head-title-container">
                                                    <h3 class="list-title uppercase sbold">Próximo Retorno</h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-12" style="display: none">
                                                <div class="list-head-summary-container">
                                                    <div class="list-pending">
                                                        <div class="badge badge-default list-count">3</div>
                                                        <div class="list-label">Aguardando</div>

                                                        <div class="list-count badge badge-default last">2</div>
                                                        <div class="list-label">Completas</div>

                                                        <div class="list-count badge badge-default last">2</div>
                                                        <div class="list-label">Canceladas</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-list-container list-default"
                                         style="overflow: auto; max-height: 263px;">
                                        <ul>

                                            <?php
                                            foreach ($retornos as $item => $value) {
                                                ?>
                                                <li class="mt-list-item">
                                                    <?php
                                                    switch ($value->status) {
                                                        case "1":
                                                            ?>
                                                            <div class="list-icon-container">
                                                                <a data-toggle="modal"
                                                                   href="#modal_agendamento"
                                                                   data-id="<?php echo $value->id ?>"
                                                                   name="abrirModalAgendamento">
                                                                    <i class="icon-check"></i>
                                                                </a>
                                                            </div>
                                                            <?php
                                                            break;
                                                        case "2":
                                                            ?>
                                                            <div
                                                                class="list-icon-container font-blue">
                                                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                            </div>
                                                            <?php
                                                            break;
                                                        case "3":
                                                            ?>
                                                            <div
                                                                class="list-icon-container font-red">
                                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                                            </div>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>

                                                    <div class="list-item-content">
                                                        <small><?php echo DataMySQLtoBR($value->data) ?></small>
                                                        <h3 class="uppercase bold">
                                                            <?php echo $value->usuario->nome ?>
                                                        </h3>
                                                        <p><?php echo $value->descricao ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-4">

                    <?php
                    if (isset($contatos)) {
                        ?>

                        <div class=" light" style="padding: 0px !important; background-color: #fff">

                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-default green-haze">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a class="badge badge-default pull-right bold" style="display: none">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <div class="list-head-title-container">
                                                    <h3 class="list-title uppercase sbold">Lista de Contato</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-list-container list-default">
                                        <ul>

                                            <?php
                                            foreach ($contatos as $item => $value) {
                                                ?>
                                                <li class="mt-list-item">
                                                    <?php
                                                    if ($value['principal'] == '1') {
                                                        ?>
                                                        <div class="list-icon-container font-blue">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="list-icon-container font-red">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="list-item-content">
                                                        <h3 class="uppercase bold">
                                                            <?php echo $value['nome'] ?>
                                                        </h3>
                                                        <p>
                                                            <?php echo $value['email'] ?>
                                                            <br>
                                                            <?php echo $value['telefone_1'] ?>
                                                            <?php
                                                            if ($value['telefone_2']) {
                                                                echo " - " . $value['telefone_2'];
                                                            }
                                                            ?>
                                                        </p>
                                                        <p>
                                                            <?php
                                                            if (isset($value['rua'])) {
                                                                echo $value['rua'];
                                                                if ($value['numero']) {
                                                                    echo ", " . $value['numero'];
                                                                }
                                                                if ($value['bairro']) {
                                                                    echo " - " . $value['bairro'];
                                                                }
                                                                if (isset($value['cidade'])) {
                                                                    echo "<br>" . $value['cidade'];
                                                                    if ($value['estado']) {
                                                                        echo " / " . $value['estado'];
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>

                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                </div>

                <?php
            }
            ?>

            <?php
            if (isset($ocorrencias)) {
            ?>
            <div class="col-md-12">

                <div class="portlet">
                    <div class="portlet-body">
                        <div class="timeline  white-bg ">

                            <?php
                            foreach ($ocorrencias as $item => $value) {
                                ?>

                                <!-- TIMELINE ITEM -->
                                <div class="timeline-item">
                                    <div class="timeline-badge">
                                        <div class="timeline-icon">
                                            <?php echo transforma_tipo_ocorrencia($value->tipo) ?>
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="timeline-body-arrow"></div>
                                        <div class="timeline-body-head">
                                            <div class="timeline-body-head-caption">
                                                <span
                                                    class="timeline-body-alerttitle font-green-haze"><?php echo $value->titulo ?></span>
                                                <span
                                                    class="timeline-body-time font-grey-cascade"><?php echo DataMySQLtoBR($value->created_at) ?></span>
                                            </div>
                                            <?php
                                            if (isset($value->usuario)) {
                                                ?>
                                                <span class="pull-right">
                                                <strong>Usuário: </strong><?php echo $value->usuario->nome ?>
                                            </span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="timeline-body-content">

                                            <p>
                                                <span class="font-grey-cascade">
                                                    <?php echo $value->descricao ?>
                                                </span>
                                            </p>

                                            <?php
                                            if (isset($value->evento) || isset($value->visita)) {
                                                ?>
                                                <br>
                                                <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                                    <?php
                                                    if (isset($value->evento)) {
                                                        ?>
                                                        <div class="ribbon ribbon-right ribbon-clip ribbon-shadow
                                                               ribbon-border-dash-hor ribbon-color-danger uppercase">
                                                            <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                                            EVENTO
                                                        </div>
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-info-circle font-red"></i>
                                                                <span class="caption-subject font-red bold uppercase">Dados do Evento</span>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            Visual demo for ribbons on Portlets. Duis
                                                            mollis, est non commodo luctus, nisi erat porttitor ligula.
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="ribbon ribbon-right ribbon-clip ribbon-shadow
                                                               ribbon-border-dash-hor ribbon-color-purple uppercase">
                                                            <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                                            VISITA
                                                        </div>
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-info-circle font-purple"></i>
                                                                <span
                                                                    class="caption-subject font-purple bold uppercase">Dados da Visita</span>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            Visual demo for ribbons on Portlets. Duis
                                                            mollis, est non commodo luctus, nisi erat porttitor ligula.
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TIMELINE ITEM -->

                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>

            <div id="modal_obs" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Nova Observação</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post"
                                  action="<?php echo base_url('eventos/acao/' . $evento->id . '/ocorrecia_obs') ?>">
                                <div class="slimScrollDiv">
                                    <div class="scroller" data-always-visible="1" data-rail-visible1="1"
                                         data-initialized="1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>
                                                    <textarea name="descricao"
                                                              class="col-md-12 form-control"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                    </button>
                                    <button type="submit" class="btn green">Salvar Ocorrencia</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_visita" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Nova Visita</h4>
                        </div>
                        <form method="post"
                              action="<?php echo base_url('eventos/acao/' . $evento->id . '/ocorrecia_visita') ?>"
                              class="form-horizontal form-row-seperated">
                            <div class="modal-body">
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Data</label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                   name="dataVisita"
                                                   placeholder="Data da Visita"
                                                   value=""
                                                   class="form-control data"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Descrição</label>
                                        <div class="col-md-9">
                                                    <textarea name="descricao"
                                                              class="col-md-12 form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                </button>
                                <button type="submit" class="btn green">Salvar Ocorrencia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal_agendamento" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Retorno Agendamento</h4>
                        </div>
                        <form method="post"
                              action="<?php echo base_url('eventos/acao/' . $id . '/retorno_agendamento') ?>"
                              class="form-horizontal form-row-seperated">
                            <input type="hidden" name="agendamento_id" id="retorno_agendamento_id">
                            <div class="modal-body">
                                <div class="form-body">

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Descrição</label>
                                        </div>
                                        <div class="col-md-12">
                                                    <textarea name="descricao"
                                                              class="col-md-12 form-control"
                                                              placeholder="Descreva como foi o retorno para o cliente"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Agendar outro retorno?</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label>
                                                <input type="radio" name="outro_agendamento" id="opcaoSim" value="Sim"
                                                       checked="">
                                                Sim
                                                <span></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="outro_agendamento" id="opcaoNao" value="Não">
                                                Não
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;" id="boxSemAgendamento">
                                        <div class="col-md-12">
                                            <label class="control-label">Finalizar Atendimento?</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label>
                                                <input type="radio" name="finalizar_atendimento" id="opcaoSimFinalizar"
                                                       value="Sim"
                                                       checked="">
                                                Sim
                                                <span></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="finalizar_atendimento" id="opcaoNaoFinalizar"
                                                       value="Não">
                                                Não
                                                <span></span>
                                            </label>
                                        </div>
                                        <div id="boxFinalizarAtendimento">
                                            <div class="col-md-12">
                                                <label class="control-label">Evento Confirmado?</label>
                                            </div>
                                            <div class="col-md-12">
                                                <label>
                                                    <input type="radio" name="evento_confirmado" id="opcaoSimConfirmado"
                                                           value="Sim"
                                                           checked="">
                                                    Sim
                                                    <span></span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="evento_confirmado" id="opcaoNaoConfirmado"
                                                           value="Não">
                                                    Não
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div style="display: none;" id="boxMotivoCancelamento">
                                                <div class="col-md-12">
                                                    <label class="control-label">Motivo do Cancelamento</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <?php
                                                    echo form_dropdown("motivo_cancelamento", $cmp_cancelamento,
                                                        '',
                                                        'class="form-control" ');
                                                    ?>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Mais Detalhes</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea name="descricao_cancelamento"
                                                              id="descricao_cancelamento"
                                                              placeholder="Mais informações sobre o cancelamento"
                                                              value=""
                                                              class="form-control "></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="boxOutroAgendamento">
                                        <div class="col-md-12">
                                            <label class="control-label">Informe a data</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text"
                                                   name="dataRetorno"
                                                   id="retorno_dataRetorno"
                                                   placeholder="Data de Retorno"
                                                   value="<?php echo date("d/m/Y H:i:s") ?>"
                                                   class="form-control data ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                </button>
                                <button type="submit" class="btn green">Salvar Ocorrencia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal_novo_agendamento" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Novo Agendamento</h4>
                        </div>
                        <form method="post"
                              action="<?php echo base_url('eventos/acao/' . $id . '/novo_agendamento') ?>"
                              class="form-horizontal form-row-seperated">
                            <div class="modal-body">
                                <div class="form-body">

                                    <div class="form-group" id="boxOutroAgendamento">
                                        <div class="col-md-12">
                                            <label class="control-label">Informe a data</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text"
                                                   name="dataRetorno"
                                                   id="retorno_dataRetorno"
                                                   placeholder="Data de Retorno"
                                                   value="<?php echo date("d/m/Y H:i:s") ?>"
                                                   class="form-control data ">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Descrição</label>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="descricaoRetorno" id="descricaoRetorno"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                </button>
                                <button type="submit" class="btn green">Salvar Ocorrencia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal_retorno_visita" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Retorno Visita</h4>
                        </div>
                        <form method="post"
                              action="<?php echo base_url('eventos/acao/' . $id . '/retorno_visita') ?>"
                              class="form-horizontal form-row-seperated">
                            <input type="hidden" name="visita_id" id="retorno_visita_id">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>
                                                <input type="radio" name="status_visita" id="opcaoStatusRetornoSim"
                                                       value="2"
                                                       checked="">
                                                Confirmar
                                                <span></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="status_visita" id="opcaoStatusRetornoNao"
                                                       value="3">
                                                Cancelar
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Descrição</label>
                                        </div>
                                        <div class="col-md-12">
                                                    <textarea name="descricao"
                                                              class="col-md-12 form-control"
                                                              placeholder="Descreva como foi a visita do cliente"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                </button>
                                <button type="submit" class="btn green">Salvar Ocorrencia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modalCancelamentoAgendamento" class="modal fade" tabindex="-1" data-backdrop="static" role="basic"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Agendamento do Evento</h4>
                        </div>
                        <form method="post">

                            <input type="hidden" name="evento_id" id="modal_evento_id">
                            <input type="hidden" name="agendamento_id" id="modal_agendamento_id">
                            <input type="hidden" name="data_agendamento_old" id="modal_data_agendamento_old">
                            <input type="hidden" name="status_old" id="modal_status_old">
                            <input type="hidden" name="data" id="modal_data">
                            <input type="hidden" name="evento_tipo_id" id="modal_evento_tipo_id">
                            <input type="hidden" name="status_id" id="modal_status">
                            <input type="hidden" name="convidados" id="modal_convidados">
                            <input type="hidden" name="descricao" id="modal_descricao">
                            <input type="hidden" name="dataRetorno" id="modal_dataRetorno">
                            <input type="hidden" name="motivo_cancelamento" id="modal_motivo_cancelamento">
                            <input type="hidden" name="descricao_cancelamento" id="modal_descricao_cancelamento">

                            <div class="modal-body">

                                <p>
                                    Exite um agendamento de retorno ativo para este evento, deseja cancelar?
                                </p>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div>
                                                <label>
                                                    <input type="radio" name="excluir_agendamento" id="opcaoSim"
                                                           value="Sim"
                                                           checked="">
                                                    Sim
                                                    <span></span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="excluir_agendamento" id="opcaoNao"
                                                           value="Não"> Não
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row" id="box_motivo_cancelamento">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="mt-radio-inline">
                                                <label>Informe o motivo</label>
                                                <textarea name="motivo" class="col-md-12 form-control"
                                                          placeholder="Qual o motivo do cancelamento do agendamento"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancelar
                                </button>
                                <button type="submit" class="btn green">Confirmar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div id="modal_contatos" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Registro de Contatos</h4>
                        </div>
                        <form method="post"
                              action="<?php echo base_url('eventos/acao/' . $id . '/registro_contatos') ?>"
                              class="form-horizontal form-row-seperated">
                            <input type="hidden" name="contato_id" id="registro_contato_id">
                            <div class="modal-body">
                                <div class="form-body">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancelar
                                </button>
                                <button type="submit" class="btn green">Salvar Contato</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    </div>
    <!-- END PAGE CONTENT-->
</div>
<!-- END CONTENT -->
