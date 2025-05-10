<?php
defined('BASEPATH') or exit('No direct script access allowed');
$url = $this->uri->segment(1);
$url_sub = $this->uri->segment(2);
?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <?php
            $x_url = trim($this->uri->segment(1));
            $x_url_2 = trim($this->uri->segment(2));
            if (!$x_url_2) {
                unset($x_url_2);
            }

            $login = $this->session->userdata('login');

            ?>

            <li class=" <?php echo (empty($x_url) || $url === 'dashboard') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <?php
            if ($login['nivel'] == 'M') {
            ?>

            <li class=" <?php echo (!empty($x_url) && $url === 'usuarios') ? 'active' : '' ?>">
                <a href="<?php echo base_url('usuarios') ?>">
                    <i class="icon-grid"></i>
                    <span class="title">Usuários</span>
                </a>
            </li>

            <li class="<?php echo (!empty($x_url) && ($url == 'categorias')) ? 'active' : '' ?>">
                <a href="javascript:;">
                    <i class="fa fa-futbol-o"></i>
                    <span class="title">Configuração</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo (!empty($x_url) && $url == 'categorias') ? 'active' : '' ?>">
                        <a href="<?php echo base_url('categorias') ?>">
                            <i class="fa fa-comment"></i>
                            Categorias</a>
                    </li>
                </ul>
            </li>

            <?php
            }
            if ($login['nivel'] == 'M' || $login['nivel'] == 'E'  || $login['nivel'] == 'G') {
            ?>
            <li class=" <?php echo (!empty($x_url) && $url === 'galeria') ? 'active' : '' ?>">
                <a href="<?php echo base_url('galeria') ?>">
                    <i class="fa fa-picture-o"></i>
                    <span class="title">Galeria</span>
                </a>
            </li>
            <?php
            }
            if ($login['nivel'] == 'M' || $login['nivel'] == 'E') {
            ?>

            <li class="<?php echo (!empty($x_url) && ($url == 'esporte' || $url == 'placar')) ? 'active' : '' ?>">
                <a href="javascript:;">
                    <i class="fa fa-futbol-o"></i>
                    <span class="title">Esporte</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo (!empty($x_url) && $url == 'esporte') ? 'active' : '' ?>">
                        <a href="<?php echo base_url('esporte') ?>">
                            <i class="fa fa-newspaper-o"></i>
                            Notícias</a>
                    </li>
                    <li class="<?php echo (!empty($x_url) && $url == 'placar') ? 'active' : '' ?>">
                        <a href="<?php echo base_url('placar') ?>">
                            <i class="fa fa-comment"></i>
                            Placar</a>
                    </li>
                </ul>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'artigo') ? 'active' : '' ?>">
                <a href="<?php echo base_url('artigo') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Artigos</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'classificado') ? 'active' : '' ?>">
                <a href="<?php echo base_url('classificado') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Classificados</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'falecimento') ? 'active' : '' ?>">
                <a href="<?php echo base_url('falecimento') ?>">
                    <i class="fa fa-ambulance"></i>
                    <span class="title">Nota de Falecimento</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'noticias') ? 'active' : '' ?>">
                <a href="<?php echo base_url('noticias') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Notícias</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'memorias') ? 'active' : '' ?>">
                <a href="<?php echo base_url('memorias') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">SB Memórias</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'capa') ? 'active' : '' ?>">
                <a href="<?php echo base_url('capa/formulario/1') ?>">
                    <i class="fa fa-cogs"></i>
                    <span class="title">Capa</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'politica') ? 'active' : '' ?>">
                <a href="<?php echo base_url('politica') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Papo de Política</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'podcast') ? 'active' : '' ?>">
                <a href="<?php echo base_url('podcast') ?>">
                    <i class="fa fa-rss"></i>
                    <span class="title">Podcast</span>
                </a>
            </li>

            <li class=" <?php echo (!empty($x_url) && $url === 'tvsbn') ? 'active' : '' ?>">
                <a href="<?php echo base_url('tvsbn') ?>">
                    <i class="fa fa-video-camera"></i>
                    <span class="title">TvSbn</span>
                </a>
            </li>
            <li class=" <?php echo (!empty($x_url) && $url === 'publicidade') ? 'active' : '' ?>">
                <a href="<?php echo base_url('publicidade') ?>">
                    <i class="fa fa-bullhorn"></i>
                    <span class="title">Publicidade</span>
                </a>
            </li>

            <?php
            }
            ?>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->