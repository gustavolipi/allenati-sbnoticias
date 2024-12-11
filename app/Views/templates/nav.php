<nav class="navbar-nav mr-auto mb-0 mb-lg-0">
    <ul>
        <li>
            <a href="<?= base_url('noticias') ?>" (click)="mostrarMenu()">Notícias</a>
        </li>
        <li>
            <a href="<?= base_url('esportes') ?>" (click)="mostrarMenu()">Esportes</a>
        </li>
        <li>
            <a href="<?= base_url('papo-de-politica') ?>" (click)="mostrarMenu()">Papo de Política</a>
        </li>
        <li>
            <a href="<?= base_url('artigos') ?>" (click)="mostrarMenu()">Artigos</a>
        </li>
        <li>
            <a href="<?= base_url('revistas') ?>" (click)="mostrarMenu()">Coluna Social</a>
        </li>
        <li style="display:none">
            <a href="<?= base_url('classificados') ?>" (click)="mostrarMenu()">Classificados</a>
        </li>
    </ul>
</nav>