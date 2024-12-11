<?php
if ($registro) {
    $seo = array(
        'title' => $registro->TITULO,
        'description' => mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($registro->CONTEUDO)), 0, 160, ""),
        'image' => @$registro->FOTO ? $tickers . 'imagens/' . $registro->FOTO :''
    );
} else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /");
}
?>
<?= view('templates/header', array('seo' => $seo)) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>
<main class="interno noticia">

    <div class="conteudo">
        <div class="container">

            <?php
            if ($registro) {
            ?>
                <div class="row">
                    <div class="col-12 col-md-1"></div>
                    <div class="col-12 col-md-10">
                        <div class="title">
                            <h1><?= $registro->TITULO ?></h1>
                        </div>
                        <div class="detail">
                            <span class="autor">Por <?= $registro->FONTE ?></span>
                            <span class="data"><?= $registro->DATACOMPLETA ?></span>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12 col-md-1"></div>
                    <div class="col-12 col-md-1">
                        <?= view('templates/botoes-compartilhamento.php', array('titulo' => $registro->TITULO)) ?>
                    </div>
                    <div class="col-12 col-md-7">

                        <article>

                            <?php
                            if (@$registro->FOTO) {
                            ?>
                                <figure>
                                    <img src="<?= $tickers . 'imagens/' . $registro->FOTO ?>">
                                    <?php
                                    if ($registro->LEGENDA) {
                                    ?>
                                        <figcaption><?= $registro->LEGENDA ?></figcaption>
                                    <?php
                                    }
                                    ?>
                                </figure>
                            <?php
                            }
                            ?>

                            <?= $registro->CONTEUDO ?>
                        </article>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="chamadas">
                            <?= view('templates/chamada-conteudo-memorias', array()) ?>
                        </div>
                        <?= view('templates/publicidade', array('tipo' => 'aside')) ?>
                        <div class="chamadas">
                            <?= view('templates/chamada-conteudo-social', array()) ?>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

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