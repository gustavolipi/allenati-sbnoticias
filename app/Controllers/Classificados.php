<?php

namespace App\Controllers;

class Classificados extends BaseController
{

    public function index($segmentoId = null): string
    {
        ini_set('display_errors', '1');
        $retorno['tickers'] = tickers;
        $retorno['segmentoId'] = $segmentoId;

        $db = \Config\Database::connect();

        $segmento_where = "";
        if ($segmentoId != null) {
            $segmento_where = "AND CATEGORIA_ID = '$segmentoId' ";
        }

        // AND DATAINICIO <= NOW() AND DATAFIM >= NOW() " . $plano_where . "
        $queryStr = "
        SELECT a.ID, a.TITULO, a.NOME, a.DESCRICAO, a.PLANO, a.EMAIL, a.TELEFONES, a.ARQUIVO, a.WHATSAPP, a.FACEBOOK, a.INSTAGRAM, a.CATEGORIA_ID, b.TITULO AS CATEGORIA
          FROM CLASSIFICADOS a
          JOIN categorias b ON b.id = a.CATEGORIA_ID
         WHERE a.DISPONIVEL = 1 AND DATAINICIO <= NOW() AND DATAFIM >= NOW() AND b.ativo = 1
         $segmento_where
         ORDER BY (CASE WHEN a.PLANO = 'ouro' THEN char(1) WHEN a.PLANO = 'prata' THEN char(2) ELSE a.PLANO END), a.created_at DESC
        ";

        $query   = $db->query($queryStr);
        $retorno['registro'] = $query->getResult();

        $db->close();

        return view('classificados', $retorno);
    }

    public function ver($classificadoId = null): string
    {
        ini_set('display_errors', '1');
        $retorno['tickers'] = tickers;

        $db = \Config\Database::connect();

        // AND DATAINICIO <= NOW() AND DATAFIM >= NOW() " . $plano_where . "
        $queryStr = "
        SELECT a.ID, a.TITULO, a.NOME, a.DESCRICAO, a.PLANO, a.EMAIL, a.TELEFONES, a.ARQUIVO, a.WHATSAPP, a.FACEBOOK, a.INSTAGRAM, a.CATEGORIA_ID, b.TITULO AS CATEGORIA
          FROM CLASSIFICADOS a
          JOIN categorias b ON b.id = a.CATEGORIA_ID
         WHERE a.DISPONIVEL = 1 AND DATAINICIO <= NOW() AND DATAFIM >= NOW() AND b.ativo = 1 AND a.ID = $classificadoId
        ";

        $query   = $db->query($queryStr);
        $registro = $query->getRow();

        if($registro){
            $retorno['segmentoId'] = $registro->CATEGORIA_ID;
        }
        
        $retorno['registro'] = $registro;

        $db->close();

        return view('classificado', $retorno);
    }
}
