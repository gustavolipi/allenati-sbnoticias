<?php

namespace App\Controllers;

class Noticias extends BaseController
{

  public function index($tipo): string
  {
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    $request = \Config\Services::request();

    $currentPage = $request->getGet('page') ? $request->getGet('page') : 1;
    $realPage = $currentPage - 1;
    $perPage = 10;
    $initPage = $realPage * $perPage;

    $seo = array(
      'title' => 'Notícias',
      'description' => "Tudo o que acontece em Santa Barbara d'Oteste e Região",
    );

    $retorno['tickers'] = tickers . 'imagens/';
    $retorno['tipo'] = $tipo;
    $retorno['titulo'] = 'TODAS AS NOTÍCIAS';
    $retorno['urlComplemento'] = 'noticia/';
    $retorno['urlPaginacao'] = 'noticias/';
    if ($tipo == 'esporte') {
      $retorno['titulo'] = 'TODAS DO ESPORTE';
      $retorno['urlPaginacao'] = 'esportes/';

      $seo = array(
        'title' => 'Notícias dos Esporte',
        'description' => "Tudo o que acontece no esporte de Santa Barbara d'Oteste e Região",
      );

    } else if ($tipo == 'artigo') {
      $retorno['titulo'] = 'ARTIGOS';
      $retorno['urlComplemento'] = 'artigo/';
      $retorno['urlPaginacao'] = 'artigos/';

      $seo = array(
        'title' => 'Artigos',
        'description' => "De análises políticas a dicas de estilo de vida, encontrará conteúdo especializado para todos os interesses",
      );

    } else if ($tipo == 'memorias') {
      $retorno['titulo'] = 'MEMÓRIAS';
      $retorno['urlComplemento'] = 'sbmemoria/';
      $retorno['urlPaginacao'] = 'sbmemorias/';
      $retorno['tickers'] = tickers . 'sbmemorias/imagens/';

      $seo = array(
        'title' => 'Memórias',
        'description' => "Reviva os momentos históricos que moldaram nossa cidade e região através de relatos cativantes e fotografias fascinantes",
      );

    } else if ($tipo == 'papo-de-politica') {
      $retorno['titulo'] = 'PAPO DE POLÍTICA';
      $retorno['urlComplemento'] = 'papo-de-politica/';
      $retorno['urlPaginacao'] = 'papo-de-politica/';

      $seo = array(
        'title' => 'Papo de Política',
        'description' => "Explore as nuances da política local e regional em nosso portal dedicado a cobrir os assuntos que moldam nossa comunidade. ",
      );

    } else if ($tipo == 'falecimentos') {
      $retorno['titulo'] = 'FALECIMENTOS';
      $retorno['urlPaginacao'] = 'falecimento/';
      $retorno['urlComplemento'] = 'falecimentos/';

      $seo = array(
        'title' => 'Falecimentos',
        'description' => "Esteja atualizado com as homenagens e memórias compartilhadas, enquanto prestamos nossos respeitos aos entes queridos e celebramos as vidas daqueles que nos deixaram.",
      );

    } else if ($tipo == 'revistas') {
      $retorno['titulo'] = 'COLUNA SOCIAL';
      $retorno['urlPaginacao'] = 'revistas/';
      $retorno['urlComplemento'] = 'revista/';
      $retorno['tickers'] = tickers . 'revista/galerias/gal';

      $seo = array(
        'title' => 'Coluna Social',
        'description' => "De festivais culturais a experiências gastronômicas únicas, mergulhe na diversidade de atividades.",
      );
    }

    $db = \Config\Database::connect();

    if ($tipo == 'artigo') {
      $sql = "SELECT ID, TITULO, CONTEUDO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA FROM ARTIGOS  WHERE DATA <= Now() ORDER BY DATA DESC LIMIT $initPage, $perPage";
      $sqlCount = "SELECT COUNT(*) as TOTAL FROM ARTIGOS WHERE DATA <= Now()";
      $qCount   = $db->query($sqlCount);
      $count = $qCount->getRow();
    } else if ($tipo == 'memorias') {
      $sql = "SELECT ID, TITULO, TEXTO AS CONTEUDO, FOTO, DATE_FORMAT(DATA, '%d/%m/%Y') AS DATACOMPLETA FROM SBMEMORIAS WHERE DATA <= NOW() ORDER BY DATA DESC LIMIT $initPage, $perPage";
      $sqlCount = "SELECT COUNT(*) as TOTAL FROM SBMEMORIAS WHERE DATA <= Now()";
      $qCount   = $db->query($sqlCount);
      $count = $qCount->getRow();
    } else if ($tipo == 'falecimentos') {
      $sql = "SELECT ID, NOME AS TITULO, INFORMACOES AS CONTEUDO, DATE_FORMAT(D_FALECIMENTO, '%d/%m/%Y') AS DATACOMPLETA FROM FALECIMENTOS ORDER BY D_FALECIMENTO DESC LIMIT $initPage, $perPage";
      $sqlCount = "SELECT COUNT(*) as TOTAL FROM FALECIMENTOS";
      $qCount   = $db->query($sqlCount);
      $count = $qCount->getRow();
    } else if ($tipo == 'revistas') {
      $sql = "SELECT a.ID, a.TITULO,  a.CATEGORIA, a.DESCRICAO AS CONTEUDO, DATE_FORMAT(a.DATA, '%d/%m/%Y') AS DATACOMPLETA, b.ARQUIVO AS FOTO
      FROM GALERIAS a 
      JOIN GALERIASLEGENDA b ON a.ID = b.GALERIA
      WHERE a.DATA <= NOW() AND b.capa = 1 ORDER BY a.DATA DESC LIMIT $initPage, $perPage";
      $sqlCount = "SELECT COUNT(*) as TOTAL FROM GALERIAS WHERE DATA <= NOW()";
      $qCount   = $db->query($sqlCount);
      $count = $qCount->getRow();
    } else {
        $sql = "SELECT ID, FOTO, CATEGORIA, TRIM(TITULO) AS TITULO, CONTEUDO, DATE_FORMAT(FROM_UNIXTIME(DataHoraInt), '%d/%m/%Y %H:%i') AS DATACOMPLETA
                FROM NOTICIASGERAL WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW()) ";
        if ($tipo == 'papo-de-politica') {
            $sql .= " AND TIPO = 'papo-de-politica' ";
        } else if ($tipo == 'esporte') {
            $sql .= " AND TIPO = 'esportes' ";
        } else {
            $sql .= " AND TIPO != 'esportes' AND TIPO != 'papo-de-politica' ";
        }
        $sql .= "ORDER BY DataHoraInt DESC LIMIT $initPage, $perPage";

        $sqlCount = "SELECT COUNT(*) AS TOTAL FROM NOTICIASGERAL WHERE DataHoraInt <= UNIX_TIMESTAMP(NOW()) AND TIPO != 'papo-de-politica' ";
        if ($tipo == 'esporte') {
            $sqlCount .= " AND TIPO = 'esportes' ";
        } else {
            $sqlCount .= " AND TIPO != 'esportes' ";
        };

        $qCount = $db->query($sqlCount);
        $count = $qCount->getRow();
    }

    //NOTICIAS ULTIMAS
    $query   = $db->query($sql);
    $retorno['registros'] = $query->getResult();

    $db->close();


    $total = isset($count->TOTAL) ? $count->TOTAL : 0;

    $retorno['pagination'] = array(
      'realPage' => $realPage,
      'currentPage' => $currentPage,
      'total' => $total,
      'totalPage' => ceil($total / $perPage),
      'perPage' => $perPage
    );

    $retorno['seo'] = $seo;

    // echo "<pre>";
    // print_r($retorno);

    return view('noticias', $retorno);
  }
}
