<?php
$seo = array(
    'title' => 'TV SB Notícias',
    'description' => 'Informações e entretenimento em um só canal, novos vídeos todos os dias!',
    'image' => base_url('public/layout/img/share-tvsbn.jpg')
);
?>
<?= view('templates/header', array('seo' => $seo)) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>
<main class="interno noticia">

    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <h1><?= $seo['title'] ?></h1>
                    <br>
                    <div class="ultimasNoticias">
                        <iframe src="https://player.logicahost.com.br/player.php?player=817" width="100%" height="580" frameborder="0" scrolling="auto" allowfullscreen=""></iframe>
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