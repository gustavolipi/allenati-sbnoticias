<?php

namespace App\Controllers;

class Falecimento extends BaseController
{

  public function index($title, $id): string
  {

    ini_set('display_errors', '1');

    $retorno['tickers'] = tickers;
    $db = \Config\Database::connect();
    $query   = $db->query("SELECT ID, NOME AS TITULO, DATE_FORMAT(D_FALECIMENTO, '%d/%m/%Y') AS DATACOMPLETA, INFORMACOES AS CONTEUDO, FONTE FROM FALECIMENTOS WHERE ID = $id");
    $retorno['registro'] = $query->getRow();

    $db->close();

    return view('noticia', $retorno);
  }
}
