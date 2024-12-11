<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/noticias', 'Noticias::index/noticia');
$routes->get('/noticia/(:any)/(:any)', 'Noticia::index/$1/$2');

$routes->get('/esportes', 'Noticias::index/esporte');
$routes->get('/esporte/(:any)/(:any)', 'Noticia::index/$1/$2');

$routes->get('/sbmemorias', 'Noticias::index/memorias');
$routes->get('/sbmemoria/(:any)/(:any)', 'Memoria::index/$1/$2');

$routes->get('/artigos', 'Noticias::index/artigo');
$routes->get('/artigo/(:any)/(:any)', 'Artigo::index/$1/$2');

$routes->get('/papo-de-politica', 'Noticias::index/papo-de-politica');
$routes->get('/papo-de-politica/(:any)/(:any)', 'Noticia::index/$1/$2');

$routes->get('/falecimentos', 'Noticias::index/falecimentos');
$routes->get('/falecimento/(:any)/(:any)', 'Falecimento::index/$1/$2');

$routes->get('/revistas', 'Noticias::index/revistas');
$routes->get('/revista/(:any)/(:any)', 'Revista::index/$1/$2');

$routes->get('/tv-sbn', 'Tv::index');

$routes->get('/api/live-youtube-json', 'Api::youtubelive');
