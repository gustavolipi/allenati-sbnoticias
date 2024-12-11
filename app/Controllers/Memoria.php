<?php

namespace App\Controllers;

class Memoria extends BaseController
{

  public function index($title, $id): string
  {
    ini_set('display_errors', '1');
    $retorno['tickers'] = tickers;
    $db = \Config\Database::connect();
    $query   = $db->query("SELECT ID, TITULO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA, TEXTO, FOTO
                             FROM SBMEMORIAS
                            WHERE DATA <= Now()
                              AND ID = $id");
    $retorno['registro'] = $query->getRow();

    $db->close();

    return view('memoria', $retorno);
  }
}
