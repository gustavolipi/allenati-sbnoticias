<?php

namespace App\Controllers;

class Home extends BaseController
{

  public function index(): string
  {

    // ini_set('display_errors', '1');
    $retorno['tickers'] = tickers;

    $db = \Config\Database::connect();

    //NOTICIAS DESTAQUE
    $query = $db->query("SELECT ID, FOTO, CATEGORIA, TRIM(TITULO) AS TITULO, CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                                 FROM NOTICIASGERAL
                                WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                                  AND PRIORIDADE = 1
                                  AND TIPO != 'esportes' 
                                ORDER BY DataHoraInt DESC
                                LIMIT 6");
    $retorno['destaques'] = $query->getResult();

    //NOTICIAS ULTIMAS
    $removerIds = array_column($retorno['destaques'], 'ID');
    $notIn = implode(", ", $removerIds);
    $query = $db->query("SELECT ID, FOTO, CATEGORIA, TRIM(TITULO) AS TITULO, CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                                 FROM NOTICIASGERAL
                                WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                                  AND ID NOT IN ($notIn) 
                                  AND TIPO != 'papo-de-politica'
                                ORDER BY DataHoraInt DESC
                                LIMIT 10");
    $retorno['ultimasnoticias'] = $query->getResult();

    //NOTICIAS DESTAQUE
    $query = $db->query("SELECT ID, FOTO, CATEGORIA, TRIM(TITULO) AS TITULO, CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                                 FROM NOTICIASGERAL
                                WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                                  AND TIPO = 'esportes'
                                ORDER BY DataHoraInt DESC
                                LIMIT 6");
    $retorno['esportes'] = $query->getResult();

    //ARTIGOS
    $query = $db->query("SELECT ID, TITULO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA
                                 FROM ARTIGOS 
                                WHERE DATA <= Now()
                                ORDER BY DATA DESC 
                                LIMIT 9");
    $retorno['artigos'] = $query->getResult();

    //FALECIMENTOS
    $query = $db->query("SELECT ID, NOME, INFORMACOES, DATE_FORMAT(D_FALECIMENTO, '%d/%m/%Y') AS DATACOMPLETA
                                 FROM FALECIMENTOS 
                                ORDER BY D_FALECIMENTO DESC 
                                LIMIT 5");
    $retorno['falecimentos'] = $query->getResult();

    //PAPO DE POLITICA
    $query = $db->query("SELECT ID, TITULO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                                 FROM NOTICIASGERAL
                                WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW())
                                  AND TIPO = 'papo-de-politica'
                                ORDER BY DataHoraInt DESC
                                LIMIT 6");
    $retorno['popodepolitica'] = $query->getResult();

    $db->close();

    // echo "<pre>";
    // print_r($retorno);

    return view('home', $retorno);
  }
}
