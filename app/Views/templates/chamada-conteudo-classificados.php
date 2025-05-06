<?php
$tickers = tickers . 'classificados';
$db = \Config\Database::connect();
$query   = $db->query("SELECT a.ID, a.TITULO, a.DESCRICAO, a.ARQUIVO, a.CATEGORIA_ID, b.TITULO AS CATEGORIA
          FROM CLASSIFICADOS a
          JOIN categorias b ON b.id = a.CATEGORIA_ID
         WHERE a.DISPONIVEL = 1 AND DATAINICIO <= NOW() AND DATAFIM >= NOW() AND b.ativo = 1 AND a.PLANO = 'ouro' ORDER BY RAND() LIMIT 3");
$classificados = $query->getResult();
$db->close();
?>
<div class="classificados">
    <div class="chamadaTitulo">
        <h2>CLASSIFICADOS</h2>
    </div>
    <div class="chamadaConteudo">
        <?php
        if ($classificados) {
        ?>
            <div class="owl-carousel owl-classificados">
                <?php
                foreach ($classificados as $item => $value) {
                ?>
                    <a class="chamada" href="<?= base_url('classificado/' . $value->ID . '/' .  url_title(convert_accented_characters($value->TITULO))) ?>" title="<?= $value->TITULO ?>">
                        <div class="image"> <img src="<?= $tickers . '/' . $value->ARQUIVO ?>" alt="<?= $value->TITULO ?>" /></div>
                        <div class="info">
                            <span class="segmento">
                                <?= $value->CATEGORIA ?>
                            </span>
                            <h2>
                                <?= $value->TITULO ?>
                                <br>
                                <small><?= mb_strimwidth(preg_replace("/\r|\n/", "...", strip_tags($value->DESCRICAO)), 0, 40, "") ?></small>
                            </h2>
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

</div>