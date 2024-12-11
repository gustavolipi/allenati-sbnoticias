<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct(){
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if($login['logged_in'] != TRUE){
            redirect(base_url('login'));
        }

        $this->usuario_nivel = $login['nivel'];

    }

	public function index()
	{

        if($this->usuario_nivel == 'M' || $this->usuario_nivel == 'E'){
            $this->load->model('Galeria_model');
            $data['galeria'] = $this->Galeria_model->where('DISPONIBILIDADE', '0')->get_all();
        }

		$this->load->view('templates/header.php', @$data);
		$this->load->view('templates/lateral.php');
		$this->load->view('dashboard.php', @$data);
		$this->load->view('templates/footer.php');
	}
}
