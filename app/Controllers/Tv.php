<?php

namespace App\Controllers;

class Tv extends BaseController
{
  public function index(): string
  {
    $retorno['tickers'] = tickers;

    return view('tv', $retorno);
  }
}
