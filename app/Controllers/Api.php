<?php

namespace App\Controllers;

class Api extends BaseController
{

  public function youtubelive()
  {

    ini_set('display_errors', '1');
    $db = \Config\Database::connect();

    //NOTICIAS ULTIMAS
    $query = $db->query("SELECT TRIM(TITULO) AS titulo
                                 FROM NOTICIASGERAL
                                WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                                  AND TIPO != 'papo-de-politica'
                                ORDER BY DataHoraInt DESC
                                LIMIT 10");
    $noticias = $query->getResult();

    $db->close();

    $retorno = [];
    $xConta = 1;
    if ($noticias) {
      foreach ($noticias as $key => $value) {
        $retorno['N' . $xConta] = $value->titulo;
        $xConta ++;
      }
    }

    // echo "<pre>";
    // print_r($retorno);

    echo json_encode($retorno);

  }
}
