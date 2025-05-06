<?php
$seo = array(
    'title' => 'Classificados',
    'description' => 'Encontre e anuncie produtos, serviços e oportunidades na seção de classificados!',
);
?>
<?= view('templates/header', array('seo' => $seo)) ?>
<?= view('templates/publicidade', array('tipo' => 'fullbanner-small', 'classificados' => 1)) ?>
<main class="interno noticia">

    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <h1><?= $seo['title'] ?></h1>
                    <br>
                    <div class="classificados">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <?= view('templates/classificados-segmentos', array('segmentoId' => @$segmentoId)) ?>

                            </div>
                            <div class="col-12 col-md-9">
                                <div class="anuncios">

                                    <?php
                                    if (isset($registro) && $registro) {
                                    ?>
                                        <ul>
                                            <li class="<?= $registro->PLANO == 'ouro' ? 'destaque' : '' ?>">
                                                <div class="item <?= $registro->ARQUIVO ? 'image' : '' ?>">
                                                    <?php
                                                    if ($registro->ARQUIVO) {
                                                    ?>
                                                        <figure>
                                                            <img src="<?= $tickers . 'classificados/' . $registro->ARQUIVO ?>" alt="<?= $registro->TITULO ?>" />
                                                        </figure>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="item-conteudo">
                                                        <h6><?= $registro->TITULO ?></h6>
                                                        <p><?= $registro->DESCRICAO ?></p>

                                                        <ul>
                                                            <?php
                                                            if ($registro->FACEBOOK) {
                                                            ?>
                                                                <li>
                                                                    <a href="https://www.facebook.com/<?= $registro->FACEBOOK ?>" target="_blank"><i class="fab fa-facebook-square"></i> <?= $registro->FACEBOOK ?></a>
                                                                </li>
                                                            <?php
                                                            }
                                                            if ($registro->INSTAGRAM) {
                                                            ?>
                                                                <li>
                                                                    <a href="https://www.instagram.com/<?= $registro->INSTAGRAM ?>" target="_blank"><i class="fab fa-instagram"></i> <?= $registro->INSTAGRAM ?></a>
                                                                </li>
                                                            <?php
                                                            }
                                                            if ($registro->WHATSAPP) {
                                                                $telefone = preg_replace("/\D/", "", $registro->WHATSAPP);
                                                                $linkWhatsApp = "https://api.whatsapp.com/send?phone=" . $telefone;
                                                            ?>
                                                                <li>
                                                                    <a href="<?= $linkWhatsApp  ?>" target="_blank"><i class="fab fa-whatsapp"></i> <?= $registro->WHATSAPP ?></a>
                                                                </li>
                                                            <?php
                                                            }
                                                            if ($registro->TELEFONES) {
                                                            ?>
                                                                <li class="d-flex">
                                                                    <i class="fas fa-phone"></i>&nbsp;<?= $registro->TELEFONES ?>
                                                                </li>
                                                            <?php
                                                            }
                                                            if ($registro->EMAIL) {
                                                            ?>
                                                                <li class="d-flex">
                                                                    <i class="far fa-envelope"></i>&nbsp;<?= $registro->EMAIL ?>
                                                                </li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <?php
                                        if (isset($fotos)) {
                                        ?>
                                            <div class="fotos">
                                                <div class="mosaico" *ngIf="mosaico.length > 0">
                                                    <div *ngFor="let foto of mosaico; let i = index">
                                                        <img [src]="foto.thumb" (click)="openLightbox(i)" />
                                                        <small>{{ foto.caption }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="chamadas">
                        <?= view('templates/chamada-conteudo-social', array()) ?>
                    </div>
                    <?= view('templates/publicidade', array('tipo' => 'aside')) ?>

                </div>
            </div>
        </div>
    </div>

    <?= view('templates/publicidade', array('tipo' => 'fullbanner-small')) ?>

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