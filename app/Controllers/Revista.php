<?php

namespace App\Controllers;

class Revista extends BaseController
{

  public function index($title, $id): string
  {

    $retorno['tickers'] = tickers . 'revista/galerias/gal';
    $db = \Config\Database::connect();
    $query   = $db->query("SELECT ID, CATEGORIA, TRIM(TITULO) AS TITULO, AUTOR, DESCRICAO AS CONTEUDO, VIDEO, DATE_FORMAT(DATA, '%d/%m/%Y às %H:%i') AS DATACOMPLETA 
                             FROM GALERIAS
                            WHERE DATA <= NOW()
                              AND ID = $id");
    $retorno['registro'] = $query->getRow();

    $query   = $db->query("SELECT ID, ARQUIVO, LEGENDA  FROM GALERIASLEGENDA WHERE GALERIA = $id ORDER BY capa DESC");
    $retorno['fotos'] = $query->getResult();

    $db->close();

    return view('revista', $retorno);
  }
}
