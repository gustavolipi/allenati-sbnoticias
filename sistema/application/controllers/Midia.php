<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midia extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');
        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }
        $this->load->model('Midia_model');
        $this->path = path_upload . 'tickers/midia/';
    }

    public function uploads()
    {
        $this->source_image = "1024_";
        $this->source_image_w = "1024";
        $this->source_image_h = "768";
        $this->load->library('image_lib');
        $x_foto = do_upload('file', $this->path);
        resizeImage($this->path . '/' . $x_foto['file_name'], $this->path . '/' . $x_foto['file_name'], 1024);
        $dados_foto = array(
            'ARQUIVO' => $x_foto['file_name'],
        );
        $this->Midia_model->insert($dados_foto);
        echo url_tikers . 'midia/' . $x_foto['file_name'] ;

    }
}
