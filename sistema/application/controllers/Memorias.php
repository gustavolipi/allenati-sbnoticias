<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memorias extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Memorias_model');
        $this->path = path_upload . 'tickers/sbmemorias/imagens/';
    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }
        $data['registros'] = $this
            ->Memorias_model
            ->order_by('DATA', 'DESC')
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['registros']) {
            $data['js'] = load_js(array("artigo.js",));
            $data['css'] = load_css(array());
        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('memorias/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'DATA'       => DataFormatar(@$post['data'], 'Y-m-d'),
                'TITULO'     => @$post['titulo'],
                'TEXTO'   => @$post['conteudo'],
                'AUTOR'      => @$post['autor']
            );

            if ($_FILES['arquivo']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo', $this->path);
                if (isset($x_foto['file_name'])) {
                    $dados['FOTO'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('memorias/formulario/' . $id));
                }
            }

            if ($id) {
                if ($_FILES['arquivo']['error'] === 0) {
                    $imagem = $this->Memorias_model->get($id);
                    if ($imagem) {
                        @unlink($this->path . $imagem->FOTO);
                    }
                }
                $this->Memorias_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Memorias_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('memorias/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Memorias_model
                ->get($id);
        }

        $data['js'] = load_js(array(
            "../../../global/plugins/bootstrap-summernote/summernote.min.js",
            'memorias_formulario.js'
        ));
        $data['css'] = load_css(array("../../../global/plugins/bootstrap-summernote/summernote.css"));

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('memorias/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $imagem = $this->Memorias_model->get($id);
                if ($imagem) {
                    @unlink($this->path . $imagem->FOTO);
                    $this->Memorias_model->delete($id);
                }
                $retorno = '5';

                break;
            case "excluir-foto":
                $imagem = $this->Memorias_model->get($id);
                if ($imagem) {
                    unlink($this->path . $imagem->FOTO);
                    $update = array("FOTO" => '');
                    $this->Memorias_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('memorias/formulario/' . $id));

                break;
        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('memorias'));
    }

}
