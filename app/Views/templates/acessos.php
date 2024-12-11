<div class="acessos d-flex ms-auto">
    <a class="chamada-radio" href="javascript:window.open('http://www.radiobrasilsbo.com.br/player/radio_aovivo.php', 'PopUpAoVivoRadioBrasilFM', 'width=420,height=571')">
        <img src="<?= base_url('public/layout/img/chamada-radio.gif') ?>" />
    </a>
    <?= view('templates/redes', array()) ?>
    <nav style="display:none">
        <ul>
            <li>
                <a href="<?= base_url('fale-conosco') ?>" (click)="mostrarMenu()">Fale Conosco</a>
            </li>
            <li class="destaque">
                <a href="<?= base_url('anuncie') ?>" (click)="mostrarMenu()">Anuncie</a>
            </li>
        </ul>
    </nav>

    <!-- <app-acesso></app-acesso> -->
</div>