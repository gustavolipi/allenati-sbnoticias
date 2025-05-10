<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvsbn extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Tvsbn_model');

    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }

        $data['tvsbn'] = $this
            ->Tvsbn_model
            ->order_by('created_at', 'DESC')
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['tvsbn']) {

            $data['js'] = load_js(array());
            $data['css'] = load_css(array());

        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('tvsbn/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {

        if ($_POST) {

            $post = getPost();

            $dados = array(
                'titulo'    => @$post['titulo'],
                'categoria' => @$post['categoria'],
                'registro'  => @$post['registro'],
                'embed'     => @$post['embed']
            );

            if ($id) {
                $this->Tvsbn_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Tvsbn_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('tvsbn/formulario/' . $id));

        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['tvsbn'] = $this
                ->Tvsbn_model
                ->with_cargo()
                ->get($id);
        }
/*
        $data['js'] = load_js();
        $data['css'] = load_css();
*/
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('tvsbn/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":

                $tvsbn = $this->Tvsbn_model->get($id);

                if ($tvsbn) {
                    $this->Tvsbn_model->delete($id);
                }

                $retorno = '5';
                $url_retorno = base_url('tvsbn');

                break;

        }

        $this->session->set_flashdata('retorno', $retorno);
        redirect($url_retorno);

    }
}
