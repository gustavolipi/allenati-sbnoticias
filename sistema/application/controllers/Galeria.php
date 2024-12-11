<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeria extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');
        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->usuario_id = null;
        if($login['nivel'] == 'G'){
            $this->usuario_id = $login['id'];
        }

        $this->load->model('Galeria_model');
        $this->load->model('Galeria_fotos_model');
    }

    public function index($pagina = 1)
    {

        $limite = 10;
        if ($pagina < 1) {
            $pagina = 1;
        }
        if (@$_GET) {
            $post = getPost();
            $where['titulo'] = @$post['palavra'];
            $limite = 10000;
        }
        if (isset($where) && (@$post['palavra'] != '' && isset($post['palavra']))) {
            $data['galeria'] = $this
                ->Galeria_model
                ->where('TITULO', 'LIKE', @$post['palavra'])
                ->where('usuario_id', @$this->usuario_id)
                ->order_by('DATA', 'DESC')
                ->paginate(1000000, NULL, $pagina);
        } else {
            $data['galeria'] = $this
                ->Galeria_model
                ->where('usuario_id', @$this->usuario_id)
                ->order_by('DATA', 'DESC')
                ->paginate(10, NULL, $pagina);
        }
        $data['atual_paginas'] = $pagina;
        if ($data['galeria']) {
            $data['js'] = load_js(array("galeria.js"));
            $data['css'] = load_css(array());
        }
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('galeria/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        $data['usuario_id'] =  $this->usuario_id;
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'DATA'            => @$post['data'],
                'TITULO'          => @$post['titulo'],
                'DESCRICAO'       => @$post['descricao'],
                'CATEGORIA'       => @$post['categoria'],
                'COLUNA'          => @$post['coluna'],
                'DISPONIBILIDADE' => $this->usuario_id == null ? @$post['disponibilidade'] : 0,
                'AUTOR'           => @$post['autor'],
                'VIDEO'           => @$post['video'],
                'usuario_id'      => @$this->usuario_id
            );
            if ($id) {
                unset($dados['usuario_id']);
                $this->Galeria_model->where('usuario_id', @$this->usuario_id)->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Galeria_model->insert($dados);;
                $retorno = '7';
            }

            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('galeria/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Galeria_model
                ->where('usuario_id', @$this->usuario_id)
                ->get($id);
        }

        $data['js'] = load_js(array('galeria_formulario.js'));
        $data['css'] = load_css(array());
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('galeria/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function fotos($id = NULL)
    {

        if ($_POST) {
            $post = getPost();
            if (!isset($post['legenda'])) {
                $legenda = NULL;
            } else {
                $legenda = $post['legenda'];
            }

            $dados = array(
                'LEGENDA' => $legenda,
            );
            $this->Galeria_fotos_model->update($dados, $post['id']);

            $retorno = '6';
            $this->session->set_flashdata('retorno', $retorno);

        }

        //PREDEFINICAO DOS CAMPOS
        $data['fotos'] = $this
            ->Galeria_model
            ->where('usuario_id', @$this->usuario_id)
            ->with_fotos()
            ->get_all($id);
        $data['js'] = load_js(
            array(
                '../../../global/plugins/jQuery-File-Upload/jquery.uploadfile.js',
                "galeria_fotos.js",
            ));
        $data['css'] = load_css(array('../../../global/plugins/jQuery-File-Upload/uploadfile.css'));
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('galeria/fotos.php', @$data);
        $this->load->view('templates/footer.php', @$data);
    }

    public function uploadFotos($id)
    {
        $this->path = path_upload . 'tickers/revista/galerias/gal' . $id;

        if (!is_dir($this->path)) {
            mkdir($this->path, 0777);
        }

        $this->source_image = "1024_";
        $this->source_image_w = "1024";
        $this->source_image_h = "768";
        $this->load->library('image_lib');
        $x_foto = do_upload('myfile', $this->path);
        if ($x_foto) {

            $foto_galeria = $this->Galeria_fotos_model->where('GALERIA', $id)->order_by('ARQUIVO', 'ASC')->get_all();
            if ($foto_galeria) {
                if (count($foto_galeria) < 10) {
                    $foto_nome = '0' . (count($foto_galeria) + 1);
                } else {
                    $foto_nome = count($foto_galeria) + 1;
                }
            } else {
                $foto_nome = '01';
            }

            $file_ext = $x_foto['file_ext'];
            $final_file_name = $foto_nome . $file_ext;
            resizeImage($this->path . '/' . $x_foto['file_name'], $this->path . '/' . $final_file_name, 1024);
            @unlink($this->path . '/' . $x_foto['file_name']);
            $data['img_foto'] = $final_file_name;
            $dados_foto = array(
                'GALERIA' => $id,
                'ARQUIVO' => $final_file_name,
            );
            $this->Galeria_fotos_model->insert($dados_foto);
            echo $final_file_name;
        }
    }

    public function carregarfotos()
    {
        $post = getPost();
        $x_imagens = $this->Galeria_fotos_model->order_by('capa', 'desc')->where($post)->get_all();
        echo json_encode($x_imagens);
    }

    public function legendafoto()
    {
        $post = getPost();
        $x_imagens = $this->Galeria_fotos_model->where($post)->get_all();
        echo json_encode($x_imagens);
    }

    public function excluirfoto()
    {
        $post = getPost();
        $x_imagens = $this->Galeria_fotos_model->get($post['id']);
        $this->path = path_upload . 'tickers/revista/galerias/gal' . $x_imagens->GALERIA;
        @unlink($this->path . '/' . $x_imagens->ARQUIVO);
        echo $this->path . '/' . $x_imagens->ARQUIVO;
        $this->Galeria_fotos_model->delete($post['id']);
    }

    public function fotocapa()
    {
        $post = getPost();
        $update = array('capa' => '0');
        $this->Galeria_fotos_model->where('GALERIA', $post['galeria_id'])->update($update);
        $update = array('capa' => '1');
        $this->Galeria_fotos_model->where('GALERIA', $post['galeria_id'])->update($update, $post['id']);
        return true;
    }

    public function acao($id, $acao)
    {
        $this->path = path_upload . 'tickers/revista/galerias/gal' . $id;
        switch ($acao) {
            case "excluir":
                $galeria = $this->Galeria_model->where('usuario_id', @$this->usuario_id)->get($id);
                if ($galeria) {
                    @unlink($this->path . '/' . $galeria->ARQUIVO);
                    $this->Galeria_model->delete($id);
                    $fotos = $this->Galeria_fotos_model->where("GALERIA", $id)->get_all();
                    if ($fotos) {
                        foreach ($fotos as $item => $value) {
                            @unlink($this->path . '/' . $value->ARQUIVO);
                        }
                        $this->Galeria_fotos_model->where("GALERIA", $id)->delete();
                    }
                    @rmdir($this->path);
                }
                $retorno = '5';
                break;
        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('galeria'));
    }

    public function json($id = NULL, $categoria = NULL, $pagina = NULL)
    {
        $galeria = $this
            ->Galeria_model
            ->where('usuario_id', @$this->usuario_id)
            ->with_fotos()
            ->order_by('data', 'DESC')
            ->paginate(12, NULL, $pagina);
        echo json_encode($galeria);
    }
}
