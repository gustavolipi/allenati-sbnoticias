<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    public function noticiaslidas($dias=15)
    {
        $this->load->model('Noticia_lida_model');
        $data_atual = date('Y-m-d H:i:s');
        $data = date('Y-m-d H:i:s', strtotime("- ".$dias." days",strtotime($data_atual)));

        $this->Noticia_lida_model->where('created_at <', $data)->delete();
        echo $this->db->last_query();
    }
}
