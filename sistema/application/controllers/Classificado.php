<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classificado extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Classificado_model');
        $this->load->model('Categorias_model');

        $this->path = path_upload . 'tickers/classificados/';
    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }

        $data['registro'] = $this
            ->Classificado_model
            ->with_categoria()
            ->order_by('created_at', 'DESC')
            ->where('id', '>', 100) //registros com a nova configuracao
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['registro']) {
            $data['js'] = load_js(array());
            $data['css'] = load_css(array());
        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('classificado/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'PLANO'         => @$post['plano'],
                'CATEGORIA_ID'  => @$post['categoria_id'],
                'TITULO'        => @$post['titulo'],
                'DESCRICAO'     => @$post['descricao'],
                'TELEFONES'     => @$post['telefones'],
                'DATAINICIO'    => DataFormatar(@$post['datainicio'], 'Y-m-d'),
                'DATAFIM'       => DataFormatar(@$post['datafim'], 'Y-m-d'),
                'DISPONIVEL'    => @$post['disponivel'],
                'WHATSAPP' => @$post['whatsapp'],
                'FACEBOOK' => @$post['facebook'],
                'INSTAGRAM' => @$post['instagram'],
            );
            if ($_FILES['arquivo']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo', $this->path);
                // echo $this->path;
                // echo "<pre>";
                // print_r($x_foto);
                // exit();
                if (isset($x_foto['file_name'])) {
                    $dados['ARQUIVO'] = $x_foto['file_name'];
                }
            }
            if ($id) {
                if ($_FILES['arquivo']['error'] === 0) {
                    $arquivo = $this->Classificado_model->get($id);
                    if ($arquivo) {
                        @unlink($this->path . $arquivo->ARQUIVO);
                    }
                }

                $this->Classificado_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Classificado_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('classificado/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Classificado_model
                ->get($id);
        }


        $data['js'] = load_js(array(
            "../../../global/plugins/bootstrap-summernote/summernote.min.js",
            'classificado_formulario.js?v=123'
        ));
        $data['css'] = load_css(array("../../../global/plugins/bootstrap-summernote/summernote.css"));

        $data['categorias'] = $this->Categorias_model->where('tipo', 1)->order_by('titulo', 'ASC')->get_all();

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('classificado/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);
    }

    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $podcast = $this->Classificado_model->get($id);
                if ($podcast) {
                    $this->Classificado_model->delete($id);
                }
                $retorno = '5';
                $url_retorno = base_url('classificado');

                break;

            case "excluir-logo":
                $galeria = $this->Classificado_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->ARQUIVO);
                    $update = array("ARQUIVO" => '');
                    $this->Classificado_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('classificado/formulario/' . $id));

                break;
        }

        $this->session->set_flashdata('retorno', $retorno);
        redirect($url_retorno);
    }
}