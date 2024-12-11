<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capa extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Capa_model');

    }

    public function formulario($id = NULL)
    {

        if ($_POST) {

            $post = getPost();

            $dados = array(
                'colunas' => @$post['colunas']
            );

            if ($id) {
                $this->Capa_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Capa_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('capa/formulario/' . $id));

        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['capa'] = $this
                ->Capa_model
                ->get($id);
        }

        $data['js'] = load_js(array('capa_formulario.js'));
        $data['css'] = '';

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('capa/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function carregarPreview()
    {
        $post = getPost();
        if ($post) {
            $this->load->model('Noticia_model');
            $data['colunas'] = $post['colunas'];
            $_where = array('limite' => $data['colunas'], 'foto' => 1, 'prioridade' => 1);
            $data['noticias'] = $this->Noticia_model->getNoticias($_where);
            echo $this->load->view('templates/capa/colunas', $data, TRUE);
        }
    }

}
