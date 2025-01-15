<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

$tickers = tickers;
$db = \Config\Database::connect();

$query = $db->query("SELECT nome_campeonato AS campeonato, status_jogo AS status, brasao_dc AS brasao_mandante, sigla_dc as sigla_mandante, gol_dc as gol_mandante, brasao_vt AS brasao_visitante, sigla_vt as sigla_visitante, gol_vt as gol_visitante FROM placar WHERE `status` = 'ativo' ORDER BY id DESC LIMIT 1");
$placar = $query->getResult();

$db->close();

if($placar && $placar[0]){
    $placar = $placar[0];
?>

<div class="chamada-placar">
    <div class="campeanato"><?=$placar->campeonato?></div>
        <div class="conteudo">
            <div class="time mandante">
                <img class="bandeira" src="<?= $tickers . 'brasao/' . $placar->brasao_mandante ?>">
                <h2><?=$placar->sigla_mandante?></h2>
            </div>
            <div class="placar">
                <?=$placar->gol_mandante?>
                <span>x</span>
                <?=$placar->gol_visitante?>
            </div>
            <div class="time visitante">
                <h2><?=$placar->sigla_visitante?></h2>
                <img class="bandeira" src="<?= $tickers . 'brasao/' . $placar->brasao_visitante ?>">
            </div>
        </div>
    <div class="status"><?=$placar->status?></div>
</div>
<?php
}
    ?>