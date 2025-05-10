<?php
if ($noticias) {
    switch ($colunas) {
        case 1:

            foreach ($noticias as $item => $value) {
                ?>
                <div class="container">
                    <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($value->TITULO)) ?>/<?= $value->ID ?>"
                       style="text-decoration: none">
                        <h1 style="font-size: 60px; color:#375f4a"><?= $value->TITULO ?></h1>
                    </a>
                    <div id="full" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $value->FOTO ?>); width: 100%; height: 596px; background-repeat: no-repeat; background-size: cover;">
                    </div>
                </div>
                <?php
            }

            break;
        case 2:
            ?>
            <div class="container">
                <div class="row">
                    <div class="form-group">
                        <?php
                        foreach ($noticias as $item => $value) {
                            ?>
                            <div id="inteiro" class="col-md-6 col-sm-12"
                                 style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $value->FOTO ?>); height: 550px; background-repeat: no-repeat; background-size: cover;">
                                <div class="row">
                                    <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($value->TITULO)) ?>/<?= $value->ID ?>"
                                       style="text-decoration: none; display: block; position: absolute; bottom: 0; width: 100%; background: rgba(0,0,0,0.2)!important; color: #FFF; padding: 25px 50px;font-size: 24px; word-wrap: break-word;">
                                        <p><?= $value->TITULO ?></p></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 3:
            ?>
            <div class="container">
                <div class="col-md-6 col-sm-12" style="margin-right: 0px; padding-right: 0px">
                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[0]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[0]->TITULO)) ?>/<?= $noticias[0]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[0]->TITULO ?></p></a>
                        </div>
                    </div>

                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[1]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[1]->TITULO)) ?>/<?= $noticias[1]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[1]->TITULO ?></p></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12" style="margin-left: 0px; padding-left: 0px">
                    <div id="inteiro" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[2]->FOTO ?>); height: 596px; background-repeat: no-repeat; background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[2]->TITULO)) ?>/<?= $noticias[2]->ID ?>"
                               style="text-decoration: none; display: block; position: absolute; bottom: 0; width: 100%; background: rgba(0,0,0,0.2)!important; color: #FFF; padding: 25px 50px;font-size: 24px; word-wrap: break-word;">
                                <p><?= $noticias[2]->TITULO ?></p></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 4:
            ?>
            <div class="container">
                <div class="col-md-6 col-sm-12" style="margin-right: 0px; padding-right: 0px">
                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[0]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[0]->TITULO)) ?>/<?= $noticias[0]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[0]->TITULO ?></p></a>
                        </div>
                    </div>

                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[1]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[1]->TITULO)) ?>/<?= $noticias[1]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[1]->TITULO ?></p></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="margin-left: 0px; padding-left: 0px">
                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[2]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[2]->TITULO)) ?>/<?= $noticias[2]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[2]->TITULO ?></p></a>
                        </div>
                    </div>

                    <div id="metade" class="col-md-12"
                         style="background-image: url(http://sbnoticias.com.br/tickers/imagens/<?= $noticias[3]->FOTO ?>); height: 298px;    background-repeat: no-repeat;     background-size: cover;">
                        <div class="row">
                            <a href="http://www.sbnoticias.com.br/noticia/<?= url_title(convert_accented_characters($noticias[3]->TITULO)) ?>/<?= $noticias[3]->ID ?>"
                               style="    display: block;position: absolute;bottom: 0;width: 100%;background: rgba(0,0,0,0.2)!important;color: #FFF;padding: 25px 50px;font-size: 24px;word-wrap: break-word;">
                                <p><?= $noticias[3]->TITULO ?></p></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
    }
}