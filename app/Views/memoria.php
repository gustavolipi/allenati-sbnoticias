<?= view('templates/header', array()) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small', 'interna' => 1)) ?>
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
                            if ($registro->FOTO) {
                            ?>
                                <figure>
                                    <img src="<?= $tickers . 'sbmemorias/imagens/' . $registro->FOTO ?>">
                                    <?php
                                    if (@$registro->LEGENDA) {
                                    ?>
                                        <figcaption><?= $registro->LEGENDA ?></figcaption>
                                    <?php
                                    }
                                    ?>
                                </figure>
                            <?php
                            }
                            ?>

                            <?= $registro->TEXTO ?>
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