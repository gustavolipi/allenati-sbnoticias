<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Falecimento extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Falecimento_model');
        $this->path = path_upload . "/falecimentos/";

    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }

        $data['registro'] = $this
            ->Falecimento_model
            ->order_by('created_at', 'DESC')
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['registro']) {
            $data['js'] = load_js(array());
            $data['css'] = load_css(array());
        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('falecimento/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
          
          	$this->db->cache_delete('falecimentos', 'falecimentoCount');
          
            $post = getPost();
            $dados = array(
                'NOME'           => @$post['nome'],
                'D_FALECIMENTO'  => @$post['d_falecimento'],
                'H_FALECIMENTO'  => DataFormatar(@$post['h_falecimento'], 'H:i:s'),
                'VELORIO'        => @$post['velorio'],
                'INFORMACOES'    => @$post['informacoes'],
                'D_SEPULTAMENTO' => @$post['d_sepultamento'],
                'H_SEPULTAMENTO' => @$post['h_sepultamento'],
                'CEMITERIO'      => @$post['cemiterio'],
                'FONTE'          => @$post['fonte'],
            );

            if ($_FILES['arquivo']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo', $this->path);
                if (isset($x_foto['file_name'])) {
                    $dados['FOTO'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('falecimento/formulario/' . $id));
                }
            }

            if ($id) {
                if ($_FILES['arquivo']['error'] === 0) {
                    $falecimento = $this->Falecimento_model->get($id);
                    if ($falecimento) {
                        @unlink($this->path . $falecimento->FOTO);
                    }
                }
                $this->Falecimento_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Falecimento_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('falecimento/formulario/' . $id));

        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Falecimento_model
                ->get($id);
        }

        $data['js'] = load_js(array('falecimento_formulario.js'));
        $data['css'] = load_css(array());

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('falecimento/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $podcast = $this->Falecimento_model->get($id);
                if ($podcast) {
                    $this->Falecimento_model->delete($id);
                }
                $retorno = '5';
                $url_retorno = base_url('falecimento');

                break;
            case "excluir-foto":
                $galeria = $this->Falecimento_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->FOTO);
                    $update = array("FOTO" => '');
                    $this->Falecimento_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('falecimento/formulario/' . $id));

                break;

        }

        $this->session->set_flashdata('retorno', $retorno);
        redirect($url_retorno);

    }
}
