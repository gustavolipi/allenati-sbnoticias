<?php

namespace App\Controllers;

class Noticia extends BaseController
{

  public function index($title, $id): string
  {
    ini_set('display_errors', '1');
    $retorno['tickers'] = tickers;
    $retorno['tickers'] = tickers;
    $db = \Config\Database::connect();
    $query   = $db->query("SELECT ID, FOTO, CATEGORIA, DATA, TRIM(TITULO) AS TITULO, LEGENDA, FONTE, CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y às %H:%i') AS DATACOMPLETA 
                             FROM NOTICIASGERAL
                            WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                              AND ID = $id");
    $retorno['registro'] = $query->getRow();

    $data = array(
      'IDNOTICIA' => $id,
      'DATA' => date('Y-m-d'),
      'HORA' => date('H:s:m'),
      'DATANOTICIA' => $retorno['registro']->DATA
    );
    $builder = $db->table('NOTICIASLIDAS');
    $builder->insert($data);

    $db->close();

    return view('noticia', $retorno);
  }
}
