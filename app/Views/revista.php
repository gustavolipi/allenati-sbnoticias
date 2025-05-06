<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if ($registro) {
    $baseImagem = $tickers . $registro->ID . '/';
    $seo = array(
        'title' => $registro->TITULO,
        'description' => mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($registro->CONTEUDO)), 0, 160, ""),
        'image' => @$fotos && @$fotos[0]->ARQUIVO ? $baseImagem . $fotos[0]->ARQUIVO : ''
    );
} else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /");
}
?>
<?= view('templates/header', array('seo' => $seo)) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small', 'revistas' => 1)) ?>
<main class="interno revista">

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
                            <span class="autor">AUTOR <?= $registro->AUTOR ?></span>
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
                            <?= $registro->CONTEUDO ?>

                            <div class="row fotos">
                                <?php
                                if ($fotos) {
                                    $xConta = 1;
                                    $baseImagem = $tickers . $registro->ID . '/';
                                    foreach ($fotos as $item => $value) {
                                        $imagem = $baseImagem . $value->ARQUIVO;
                                ?>
                                        <div class="col-6 col-md-4">
                                            <a href="<?= $imagem ?>" data-lightbox="roadtrip" class="foto">
                                                <figure><img src="<?= $imagem ?>"></figure>
                                            </a>
                                        </div>
                                        <?php
                                        $xConta++;
                                        if ($xConta == 10) {
                                            $xConta = 1;
                                        ?>
                                            <?= view('templates/publicidade', array('tipo' => 'fullbanner-conteudo')) ?>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
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