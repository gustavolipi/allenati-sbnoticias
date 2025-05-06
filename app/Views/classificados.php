<?php
$seo = array(
    'title' => 'Classificados',
    'description' => 'Encontre e anuncie produtos, serviços e oportunidades na seção de classificados!',
);
?>
<?= view('templates/header', array('seo' => $seo)) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small', 'classificados' => 1)) ?>
<main class="interno noticia">

    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <h1><?= $seo['title'] ?></h1>
                    <br>
                    <div class="classificados">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <?= view('templates/classificados-segmentos', array('segmentoId' => @$segmentoId)) ?>

                            </div>
                            <div class="col-12 col-md-9">
                                <div class="anuncios">
                                    <ul>
                                        <?php
                                        if (isset($registro) && $registro) {
                                            foreach ($registro as $key => $value) {
                                        ?>
                                                <li class="<?= $value->PLANO == 'ouro' ? 'destaque' : '' ?>">
                                                    <a class="item <?= $value->ARQUIVO ? 'image' : '' ?>"
                                                        href="<?= base_url('/classificado/' . $value->ID . '/' . url_title(convert_accented_characters($value->TITULO))) ?>">
                                                        <?php
                                                        if ($value->ARQUIVO) {
                                                        ?>
                                                            <figure>
                                                                <img src="<?= $tickers . 'classificados/' . $value->ARQUIVO ?>" alt="<?= $value->TITULO ?>" />
                                                            </figure>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="item-conteudo">
                                                            <span class="segmento">
                                                                <?= $value->CATEGORIA ?>
                                                            </span>
                                                            <h6>
                                                                <?= $value->TITULO ?>
                                                                <small><?= $value->DESCRICAO ?></small>
                                                            </h6>

                                                            <strong>Saiba Mais</strong>
                                                        </div>
                                                    </a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="chamadas">
                        <?= view('templates/chamada-conteudo-social', array()) ?>
                    </div>
                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>

                </div>
            </div>
        </div>
    </div>

    <?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>

    <div class="conteudo conteudomaislidads">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <?= view('templates/chamada-conteudo-noticias-mais-lidas', array()) ?>
                </div>
                <div class="col-12 col-md-3">
                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>
                </div>
            </div>
        </div>
    </div>

</main>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-medio')) ?>
<?= view('templates/footer', array('js' => '')) ?>