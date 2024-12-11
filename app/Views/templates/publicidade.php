<div class="publicidade <?= $tipo ?>">
  <?php
  switch (@$tipo) {
    case 'fullbanner-small':

      $db = \Config\Database::connect();

      $query = $db->query("SELECT arquivo, codigo FROM publicidade WHERE tipo = 1 AND (data_inicio <= CURDATE() AND data_fim >= CURDATE()) ORDER BY RAND() LIMIT 1");
      $pub = $query->getResult();

      $db->close();

      if ($pub) {
        echo $pub[0]->codigo;
      } else {
        ?>

        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6540567271299057" data-ad-slot="9712220284"
          data-ad-format="auto" data-full-width-responsive="true"></ins>

        <?php
        break;
      }

    case 'fullbanner-conteudo':
      ?>
      <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6540567271299057" data-ad-slot="6348023486"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
      <?php
      break;
    case 'fullbanner-medio':
      ?>
      <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6540567271299057" data-ad-slot="6348023486"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
      <?php
      break;
    case 'aside':

      ?>
      <ins class="adsbygoogle" style="display:inline-block;width:250px;height:250px"
        data-ad-client="ca-pub-6540567271299057" data-ad-slot="4729877430"></ins>

      <?php
      break;
      
    case 'fam':
      ?>
      <a href="https://info.fam.br/prova-de-bolsas/?utm_source=SB+noticias+&utm_medium=Banner&utm_campaign=Prova+de+bolsas+%7C+2025.1&utm_id=Prova+de+bolsas"
        target="_blank"
        title="Prova de Bolsas">
        <img src="<?= base_url('public/layout/publicidade/Prova_de_Bolsas_20251_Portal_300x250.png') ?>"
          alt="Prova de Bolsas" />
      </a>
      <?php
      break;
    default:
      # code...
      break;
  }
  ?>
</div>