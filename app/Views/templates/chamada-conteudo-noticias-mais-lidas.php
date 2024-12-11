<?php
$tickers = tickers;

$db = \Config\Database::connect();

$query   = $db->query("SELECT count(*) as total, a.IDNOTICIA, a.DATANOTICIA,  
                                      b.ID, b.DATA, b.HORA, b.FOTO, b.LEGENDA, b.FOTOCAPA, b.PRIORIDADE, b.TIPO, b.CATEGORIA, b.TITULO, b.FONTE, 
                                      b.CHAMADA, b.CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                                 FROM NOTICIASLIDAS a 
                                 JOIN NOTICIASGERAL b ON b.ID = a.IDNOTICIA 
                                WHERE ((a.IDNOTICIA <> 0) AND (a.DATANOTICIA > (DATE_SUB(CURDATE(), INTERVAL 2 DAY))))
                                GROUP BY a.IDNOTICIA 
                                ORDER BY total DESC, a.DATANOTICIA DESC 
                                LIMIT 9");
$maislidas = $query->getResult();

$db->close();
?>


<div class="chamadaTitulo">
    <h2>NOTÍCIAS MAIS LIDAS</h2>
</div>

<div class="noticiasMaisLidas">
    <?php
    if ($maislidas) {
        foreach ($maislidas as $item => $value) {
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