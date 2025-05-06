<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    public function index()
    {

        $this->load->view('teste', @$data);

    }


}
