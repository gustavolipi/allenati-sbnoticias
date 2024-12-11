<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artigo extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Artigo_model');
    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }
        $data['registros'] = $this
            ->Artigo_model
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
        $this->load->view('artigo/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'DATA'       => DataFormatar(@$post['data'], 'Y-m-d'),
                'TITULO'     => @$post['titulo'],
                'CONTEUDO'   => @$post['conteudo'],
                'AUTOR'      => @$post['autor']
            );
            if ($id) {
                $this->Artigo_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Artigo_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('artigo/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Artigo_model
                ->get($id);
        }

        $data['js'] = load_js(array(
            "../../../global/plugins/bootstrap-summernote/summernote.min.js",
            'artigo_formulario.js'
        ));
        $data['css'] = load_css(array("../../../global/plugins/bootstrap-summernote/summernote.css"));

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('artigo/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    /*
        public function fotos($id = null)
        {

            //PREDEFINICAO DOS CAMPOS
            $data['fotos'] = $this
                ->Artigo_model
                ->with_fotos()
                ->get_all($id);

            $data['js'] = load_js(
                array(
                    '../../../global/plugins/jQuery-File-Upload/jquery.uploadfile.js',
                    "infraestrutura_fotos.js",
                ));
            $data['css'] = load_css(array('../../../global/plugins/jQuery-File-Upload/uploadfile.css'));

            $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

            $this->load->view('templates/header.php', @$data);
            $this->load->view('templates/lateral.php', @$data);
            $this->load->view('infraestrutura/fotos.php', @$data);
            $this->load->view('templates/footer.php', @$data);

        }

        public function uploadFotos($id)
        {

            $this->path = path_upload . 'infraestrutura';

            $this->source_image = "1024_";
            $this->source_image_w = "1024";
            $this->source_image_h = "768";

            $this->load->library('image_lib');

            $x_foto = do_upload('myfile', $this->path);

            if ($x_foto) {

                resizeImage($this->path . '/' . $x_foto['file_name'], $this->path . '/' . $x_foto['file_name'], 1024);

                $data['img_foto'] = $x_foto['file_name'];

                $dados_foto = array(
                    'infraestrutura_id' => $id,
                    'arquivo' => $x_foto['file_name'],
                );

                $this->Infraestrutura_fotos_model->insert($dados_foto);

                echo $x_foto['file_name'];

            }

        }

        public function carregarfotos()
        {
            $post = getPost();

            $x_imagens = $this->Infraestrutura_fotos_model->where($post)->get_all();
            echo json_encode($x_imagens);
        }

        public function legendafoto()
        {
            $post = getPost();

            $x_imagens = $this->Infraestrutura_fotos_model->where($post)->get_all();

            echo json_encode($x_imagens);

        }

        public function excluirfoto()
        {
            $post = getPost();

            $x_imagens = $this->Artigo_model->get($post['id']);
            @unlink($this->path . $x_imagens->arquivo);
            $this->Artigo_model->delete($post['id']);
        }
*/
    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $galeria = $this->Artigo_model->get($id);
                if ($galeria) {
                    //unlink($this->path . $galeria->arquivo);
                    $this->Artigo_model->delete($id);
                    /*
                                        $fotos = $this
                                            ->Infraestrutura_fotos_model
                                            ->where("infraestrutura_id", $id)->get_all();
                                        if ($fotos) {
                                            foreach ($fotos as $item => $value) {
                                                unlink(path_upload . 'infraestrutura/' . $value->arquivo);
                                            }
                                            $this->Infraestrutura_fotos_model->where("infraestrutura_id", $id)->delete();
                                        }
                    */
                }
                $retorno = '5';

                break;
/*
            case "excluir-foto":
                $galeria = $this->Artigo_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->FOTO);
                    $update = array("FOTO" => '');
                    $this->Artigo_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('noticias/formulario/' . $id));

                break;
*/
        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('artigo'));
    }
    /*
        public function json($id = null, $categoria = null, $pagina = null)
        {
            $infraestrutura = $this
                ->Artigo_model
                ->with_fotos()
                ->order_by('nome', 'ASC')
                ->paginate(12, null, $pagina);

            echo json_encode($infraestrutura);
        }
    */
}
