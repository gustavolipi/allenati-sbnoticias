<?php

namespace App\Controllers;

class Artigo extends BaseController
{

  public function index($title, $id): string
  {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');


    $retorno['tickers'] = tickers;
    $db = \Config\Database::connect();
    $query   = $db->query("SELECT ID, TITULO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA, CONTEUDO, AUTOR AS FONTE
                             FROM ARTIGOS
                            WHERE DATA <= Now()
                              AND ID = $id");
    $retorno['registro'] = $query->getRow();

    $db->close();

    return view('noticia', $retorno);
  }
}
