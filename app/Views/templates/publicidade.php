<div class="publicidade <?= $tipo ?>">
  <?php
  switch (@$tipo) {
    case 'fullbanner-small':
      // Conectar ao banco
      $db = \Config\Database::connect();

      // Lista de categorias válidas
      $categorias = ['capa', 'interna', 'esporte', 'noticia', 'classificados', 'revistas', 'podcasts', 'tv'];

      if(isset($capa)) $filtros[] = "capa = 1";
      if(isset($interna)) $filtros[] = "interna = 1";
      if(isset($esporte)) $filtros[] = "esporte = 1";
      if(isset($noticia)) $filtros[] = "noticia = 1";
      if(isset($classificados)) $filtros[] = "classificados = 1";
      if(isset($revistas)) $filtros[] = "revistas = 1";
      if(isset($podcasts)) $filtros[] = "podcasts = 1";
      if(isset($tv)) $filtros[] = "tv = 1";

      // Montar a condição WHERE dinamicamente
      $whereCondicao = !empty($filtros) ? 'AND (' . implode(' OR ', $filtros) . ')' : '';

      // Montar a consulta
      $sql = "SELECT arquivo, codigo, link, target 
        FROM publicidade 
        WHERE tipo = 1 
        AND (data_inicio <= CURDATE() AND data_fim >= CURDATE()) 
        $whereCondicao 
        ORDER BY RAND() 
        LIMIT 1";

      // Executar a query
      $query = $db->query($sql);
      $pub = $query->getResult();

      if ($pub) {
        if ($pub[0]->codigo) {
          echo $pub[0]->codigo;
        } else {
          $img =  $tickers . 'publicidade/' . $pub[0]->arquivo;
  ?>
          <a href="<?= $pub[0]->link ?>"
            target="<?= $pub[0]->target ?>">
            <img src="<?= $img ?>" />
          </a>
        <?php
        }
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
      <a href="https://info.fam.br/cursos/pos-graduacao/?utm_source=+Portal+Brasil+FM&utm_medium=Banner&utm_campaign=P%C3%B3s+Gradua%C3%A7%C3%A3o+2025&utm_term=P%C3%B3s+FAM"
        target="_blank"
        title="Prova de Bolsas">
        <img src="<?= base_url('public/layout/publicidade/Prova_de_Bolsas_20251_Portal_300x250-3.gif') ?>"
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