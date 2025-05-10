<?= view('templates/header', array()) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small', 'capa' => 1)) ?>

<main class="home">

    <?php
    if ($destaques) {
        $partes = array_chunk($destaques, 4);
    ?>
        <div class="destaques">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="owl-carousel owl-destaques">
                            <?php
                            foreach ($partes[0] as $item => $value) {
                            ?>
                                <div class="item" style="">
                                    <a href="<?= base_url('noticia/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>">
                                        <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>" class="blur">
                                        <div class="info">
                                            <div>
                                                <span class="cat"><?= $value->CATEGORIA ?></span>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h3 class="titulo"><?= $value->TITULO ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="row">
                            <?php
                            foreach ($partes[1] as $item => $value) {
                            ?>
                                <div class="col-md-6 col-12">
                                    <div class="outros">
                                        <a href="<?= base_url('noticia/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                            <div class="thumb">
                                                <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>">
                                            </div>
                                            <div class="info">
                                                <div>
                                                    <span class="cat"><?= $value->CATEGORIA ?></span>
                                                    <span><?= $value->DATACOMPLETA ?></span>
                                                </div>
                                                <h3 class="titulo">
                                                    <?= $value->TITULO ?>
                                                    <small style="display: none !important"><?= mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($value->CONTEUDO)), 0, 200, "") ?></small>
                                                </h3>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <?= view('templates/chamada-conteudo-classificados', array()) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <?php
    echo view('templates/chamada-placar');
    ?>

    <div class="chamadas">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <?= view('templates/chamada-conteudo-memorias', array('memorias' => @$memorias)) ?>
                </div>
                <div class="col-12 col-md-3">
                    <?= view('templates/chamada-conteudo-social', array()) ?>
                </div>
                <div class="col-12 col-md-3">
                    <?= view('templates/chamada-conteudo-tv', array()) ?>
                </div>
                <div class="col-12 col-md-3">
                    <?= view('templates/chamada-conteudo-radio', array()) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">

                    <div class="chamadaTitulo">
                        <h2>ULTÍMAS NOTÍCIAS</h2>
                    </div>

                    <div class="ultimasNoticias">
                        <?php
                        if ($ultimasnoticias) {
                            $xConta = 0;
                            foreach ($ultimasnoticias as $item => $value) {
                        ?>
                                <article>
                                    <a class="<?= $value->FOTO == '' ? 'semFoto' : '' ?>" href="<?= base_url('noticia/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <?php
                                        if ($value->FOTO) {
                                        ?>
                                            <figure>
                                                <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>">
                                            </figure>
                                        <?php
                                        }
                                        ?>
                                        <div class="info">
                                            <div>
                                                <span class="cat"><?= $value->CATEGORIA ?></span>
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

                            <div class="acao">
                                <a class="btn" href="<?= base_url('/noticias'); ?>" title="Ver mais notícias">VER MAIS NOTÍCIAS</a>
                            </div>


                        <?php
                        } else {
                        ?>
                            <p>Não foi possível carregar as notícias!</p>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="col-12 col-md-3">
                    <?= view('templates/publicidade', array('tipo' => 'fam')) ?>

                    <?php
                    if (@$falecimentos) {
                    ?>
                        <div class="falecimentos">
                            <div class="chamadaTitulo">
                                <h2>FALECIMENTOS</h2>
                            </div>
                            <?php
                            foreach ($falecimentos as $item => $value) {
                            ?>
                                <article>
                                    <a href="<?= base_url('falecimento/' . url_title(convert_accented_characters($value->NOME)) . '/' . $value->ID) ?>" title="<?= $value->NOME ?>">
                                        <div class="info">
                                            <div>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h2><?= $value->NOME ?></h2>
                                            <p><?= mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($value->INFORMACOES)), 0, 200, "") ?></p>
                                        </div>
                                    </a>
                                </article>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>

                    <?php
                    if (@$popodepolitica) {
                    ?>
                        <div class="papoDePolitica">
                            <div class="chamadaTitulo">
                                <h2>PAPO DE POLÍTICA</h2>
                            </div>
                            <?php
                            foreach ($popodepolitica as $item => $value) {
                            ?>
                                <article>
                                    <a href="<?= base_url('papo-de-politica/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <div class="info">
                                            <div>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h2><?= $value->TITULO ?></h2>
                                        </div>
                                    </a>
                                </article>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>

                </div>
            </div>
        </div>
    </div>

    <?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>

    <div class="conteudo esporte">
        <?php
        if ($esportes) {
            $partes = array_chunk($esportes, 4);
        ?>
            <div class="destaques">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12">

                            <div class="owl-carousel owl-destaques">
                                <?php
                                foreach ($partes[0] as $item => $value) {
                                ?>
                                    <div class="item">
                                        <a href="<?= base_url('noticia/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                            <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>">
                                            <div class="info">
                                                <div>
                                                    <span class="cat"><?= $value->CATEGORIA ?></span>
                                                    <span><?= $value->DATACOMPLETA ?></span>
                                                </div>
                                                <h3 class="titulo"><?= $value->TITULO ?></h3>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        foreach ($partes[1] as $item => $value) {
                        ?>
                            <div class="col-md-3 col-12">
                                <div class="outros">
                                    <a href="<?= base_url('noticia/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <div class="thumb">
                                            <img src="<?= $tickers . 'imagens/' . $value->FOTO ?>">
                                        </div>
                                        <div class="info">
                                            <div>
                                                <span class="cat"><?= $value->CATEGORIA ?></span>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h3 class="titulo">
                                                <?= $value->TITULO ?>
                                                <small><?= mb_strimwidth(preg_replace("/\r|\n/", "", strip_tags($value->CONTEUDO)), 0, 200, "") ?></small>
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="acao">
                    <a class="btn" href="<?= base_url('/esportes'); ?>" title="Ver mais notícias">VER MAIS NOTÍCIAS</a>
                </div>
            </div>
        </div>

        <?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>
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

    <div class="conteudo conteudoartigos">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">

                    <div class="chamadaTitulo">
                        <h2>ARTIGOS</h2>
                    </div>

                    <div class="artigos">
                        <?php
                        if ($artigos) {
                            foreach ($artigos as $item => $value) {
                        ?>
                                <article>
                                    <a href="<?= base_url('artigo/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                                        <div class="info">
                                            <div>
                                                <span><?= $value->DATACOMPLETA ?></span>
                                            </div>
                                            <h2><?= $value->TITULO ?></h2>
                                        </div>
                                    </a>
                                </article>
                            <?php
                            }
                        } else {
                            ?>
                            <p>Não foi possível carregar as notícias mais lidas!</p>
                        <?php
                        }
                        ?>
                    </div>

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