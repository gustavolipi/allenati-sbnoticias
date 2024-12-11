<?php
$url = @$url == '' ? site_url(uri_string()) : $url;
?>
<div class="redes">
    <ul>
        <li><a href="whatsapp://send?text=<?= $titulo ?> <?= $url ?>" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
        <li><a href="http://www.facebook.com/share.php?u=<?= $url ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="https://twitter.com/share?url=<?= $url ?>&text=<?= $titulo ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
    </ul>
</div>