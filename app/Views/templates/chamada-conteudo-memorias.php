<?php
$tickers = tickers . 'sbmemorias/imagens/';

$db = \Config\Database::connect();
$query   = $db->query("SELECT ID, TITULO, TEXTO, FOTO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA
                         FROM SBMEMORIAS
                        WHERE DATA <= NOW()
                        ORDER BY DATA DESC
                        LIMIT 1");
$memorias = $query->getResult();
$db->close();
?>

<div class="memorias">
    <div class="chamadaTitulo">
        <h2>MEMÓRIAS</h2>
    </div>
    <div class="chamadaConteudo">
        <?php
        if (@$memorias) {
            foreach ($memorias as $item => $value) {
        ?>
                <a class="chamada " href="<?= base_url('sbmemoria/' . url_title(convert_accented_characters($value->TITULO)) . '/' . $value->ID) ?>" title="<?= $value->TITULO ?>">
                    <div class="image"><img src="<?= $tickers . $value->FOTO ?>" alt="<?= $value->TITULO ?>"></div>
                    <div class="info"><span><?= $value->DATACOMPLETA ?></span>
                        <h2><?= $value->TITULO ?></h2>
                    </div>
                </a>
        <?php
            }
        }
        ?>
    </div>
    <div class="chamadaLink">
        <a title="Ver mais memórias" href="<?= base_url('/sbmemorias') ?>">VER MAIS MEMÓRIAS</a>
    </div>
</div>