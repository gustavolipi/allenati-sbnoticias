<a class="navbar-brand" href="<?= base_url() ?>" title="Logo SB Notícias">
    <img src="<?= base_url('public/layout/img/logo.png') ?>" alt="Logo SB Notícias" />
</a>
<div class="menu-mobile">
    <?= view('templates/chamada-radio', array()) ?>
    <?= view('templates/redes', array()) ?>
    <a class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
        <i class="fas fa-bars"></i>
    </a>
</div>