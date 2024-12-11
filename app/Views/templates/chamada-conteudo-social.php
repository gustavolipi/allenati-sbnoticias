<?php
$tickers = tickers . 'revista/galerias/gal';
$db = \Config\Database::connect();
$query   = $db->query("SELECT a.ID, a.TITULO, b.ARQUIVO AS FOTO, a.CATEGORIA, DATE_FORMAT(a.DATA, '%d/%m/%Y') AS DATACOMPLETA 
                         FROM GALERIAS a
                         JOIN GALERIASLEGENDA b ON b.GALERIA = a.ID 
                                               AND b.capa = 1
                        WHERE a.DATA <= Now()
                        ORDER BY a.DATA DESC
                        LIMIT 6");
$social = $query->getResult();
$db->close();
?>
<div class="social">
    <div class="chamadaTitulo">
        <h2>COLUNA SOCIAL</h2>
    </div>
    <div class="chamadaConteudo">
        <?php
        if ($social) {
        ?>
            <div class="owl-carousel owl-social">
                <?php
                foreach ($social as $item => $value) {
                ?>
                        <a class="chamada" href="<?= base_url('revista/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                            <div class="image"><img src="<?= $tickers . $value->ID . "/" . $value->FOTO ?>"></div>
                            <div class="info">
                                <div>
                                    <span class="cat"><?= $value->CATEGORIA ?></span>
                                    <span><?= $value->DATACOMPLETA ?></span>
                                </div>
                                <h2><?= $value->TITULO ?></h2>
                            </div>
                        </a>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="chamadaLink">
        <a title="Ver mais fotos" href="<?= base_url('/revistas') ?>">VER MAIS FOTOS</a>
    </div>
</div>