<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImageCrop extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }
        $this->path = path_upload . 'tickers/classificados/';
    }


    public function index()
    {

        $filename = basename($_GET['img']);
        $path = $this->path . $filename;

        $img_r = imagecreatefromstring(file_get_contents($_GET['img']));
        $dst_r = ImageCreateTrueColor($_GET['w'], $_GET['h']);

        imagecopyresampled($dst_r, $img_r, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h'], $_GET['w'], $_GET['h']);
        imagejpeg($dst_r, $path);

        exit;
    }
}