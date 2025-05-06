<?php
$tickers = tickers . 'sbmemorias/imagens/';

$db = \Config\Database::connect();
// AND DATAINICIO <= NOW() AND DATAFIM >= NOW()
$queryStrSegmento = "SELECT a.*
                FROM categorias a
                JOIN CLASSIFICADOS b ON b.CATEGORIA_ID = a.id
                WHERE a.ativo = 1 AND b.DISPONIVEL = 1
                AND DATAINICIO <= NOW() AND DATAFIM >= NOW()
                GROUP BY a.ID
                ORDER BY a.titulo ASC";

$querySegmentos   = $db->query($queryStrSegmento);
$segmentos = $querySegmentos->getResult();
$db->close();
?>
<div class="menu-segmentos">
    <h3> Segmentos<i class="fas fa-chevron-down"></i> </h3>
    <ul id="segmentos">
        <?php
        if (isset($segmentos) && $segmentos) {
            foreach ($segmentos as $key => $value) {
        ?>
                <li class="<?= isset($segmentoId) && $value->id == $segmentoId ? 'active' : '' ?>">
                    <a href="<?= base_url('/classificados/' . $value->id . '/' . url_title(convert_accented_characters($value->titulo))) ?>"><?= $value->titulo ?></a>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>