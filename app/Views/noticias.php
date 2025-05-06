<?= view('templates/header', array()) ?>

<?php
if($tipo == 'esportes' || $tipo == 'esporte'){
    echo view('templates/publicidade', array('tipo' => 'fullbanner-small', 'esporte' => 1));
    echo view('templates/chamada-placar');
   
}else{
    echo view('templates/publicidade', array('tipo' => 'fullbanner-small', 'noticia' => 1));
}
?>

<main class="interno noticias">

    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">

                    <h1><?= $titulo ?></h1>

                    <div class="ultimasNoticias">
                        <?php
                        if ($registros) {
                            $xConta = 0;
                            foreach ($registros as $item => $value) {
                                $baseImagem = $tickers;
                                if ($tipo == 'revistas') {
                                    $baseImagem = $tickers . $value->ID . '/';
                                }
                        ?>
                                <article>
                                    <a class="<?= @!$value->FOTO || $tipo == 'papo-de-politica' ? 'semFoto' : '' ?>" href="<?= base_url($urlComplemento . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <?php
                                        if (@$value->FOTO && $tipo != 'papo-de-politica' ) {
                                        ?>
                                            <figure>
                                                <img src="<?= $baseImagem . $value->FOTO ?>">
                                            </figure>
                                        <?php
                                        }
                                        ?>
                                        <div class="info">
                                            <div>
                                                <?php
                                                if (@$value->CATEGORIA) {
                                                ?>
                                                    <span class="cat"><?= $value->CATEGORIA ?></span>
                                                <?php
                                                }
                                                ?>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h2><?= $value->TITULO ?></h2>
                                            <p><?= mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($value->CONTEUDO)), 0, 200, "") ?></p>
                                        </div>
                                    </a>
                                </article>
                                <?php
                                $xConta++;
                                if ($xConta == 3 || $xConta == 7) {
                                ?>
                                    <?= view('templates/publicidade', array('tipo' => 'fullbanner-conteudo')) ?>
                            <?php
                                }
                            }
                            ?>

                        <?php
                        } else {
                        ?>
                            <p>Não foi possível carregar as notícias!</p>
                        <?php
                        }
                        ?>
                    </div>

                    <div id="paginacao"></div>

                </div>
                <div class="col-12 col-md-3">
                    <div class="chamadas">
                        <?= view('templates/chamada-conteudo-social', array()) ?>
                    </div>
                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>
                    <div class="chamadas">
                        <?= view('templates/chamada-conteudo-memorias', array()) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    var realPage = <?= $pagination['realPage'] ?>;
    var currentPage = <?= $pagination['currentPage'] ?>;
    var total = <?= $pagination['total'] ?>;
    var totalPage = <?= $pagination['totalPage'] ?>;
    var perPage = <?= $pagination['perPage'] ?>;
    var href = '<?= $urlPaginacao ?>';
</script>

<?= view('templates/publicidade', array('tipo' => 'fullbanner-medio')) ?>
<?= view('templates/footer', array('js' => 'noticias.js')) ?>