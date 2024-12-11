<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Esporte extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Noticia_model');
        $this->path = path_upload . 'tickers/imagens/';
    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }
        $data['registros'] = $this
            ->Noticia_model
            ->where('TIPO', 'esportes')
            ->order_by('DATA', 'DESC')
            ->order_by('HORA', 'DESC')
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['registros']) {
            $data['js'] = load_js(array("noticias.js",));
            $data['css'] = load_css(array());
        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('esporte/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'DATA'       => DataFormatar(@$post['data'], 'Y-m-d'),
                'HORA'       => DataFormatar(@$post['hora'], 'H:i:s'),
                'TITULO'     => @$post['titulo'],
                'LEGENDA'    => @$post['legenda'],
                'CONTEUDO'   => @$post['conteudo'],
                'TIPO'      => 'esportes',
                'CATEGORIA'  => @$post['categoria'],
                'PRIORIDADE' => @$post['prioridade']
            );

            if ($_FILES['arquivo']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo', $this->path);
                if (isset($x_foto['file_name'])) {
                    $dados['FOTO'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('esporte/formulario/' . $id));
                }
            }

            if ($id) {

                if ($_FILES['arquivo']['error'] === 0) {
                    $noticia = $this->Noticia_model->get($id);
                    if ($noticia) {
                        @unlink($this->path . $noticia->FOTO);
                    }
                }

                $this->Noticia_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Noticia_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('esporte/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Noticia_model
                ->where('TIPO', 'esportes')
                ->get($id);
        }

        $data['js'] = load_js(array(
            "../../../global/plugins/bootstrap-summernote/summernote.min.js",
            'noticias_formulario.js'
        ));
        $data['css'] = load_css(array("../../../global/plugins/bootstrap-summernote/summernote.css"));

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('esporte/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);
    }

    /*
        public function fotos($id = null)
        {

            //PREDEFINICAO DOS CAMPOS
            $data['fotos'] = $this
                ->Noticia_model
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

            $x_imagens = $this->Noticia_model->get($post['id']);
            @unlink($this->path . $x_imagens->arquivo);
            $this->Noticia_model->delete($post['id']);
        }
*/
    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $galeria = $this->Noticia_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->arquivo);
                    $this->Noticia_model->delete($id);
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

            case "excluir-foto":
                $galeria = $this->Noticia_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->FOTO);
                    $update = array("FOTO" => '');
                    $this->Noticia_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('esporte/formulario/' . $id));

                break;
        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('esporte'));
    }
    /*
        public function json($id = null, $categoria = null, $pagina = null)
        {
            $infraestrutura = $this
                ->Noticia_model
                ->with_fotos()
                ->order_by('nome', 'ASC')
                ->paginate(12, null, $pagina);

            echo json_encode($infraestrutura);
        }
    */
}
