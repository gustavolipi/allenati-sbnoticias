<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Placar extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }

        $this->load->model('Placar_model');
        $this->path = path_upload . 'tickers/brasao/';
    }

    public function index($pagina = 1)
    {
        if ($pagina < 1) {
            $pagina = 1;
        }
        $data['registros'] = $this
            ->Placar_model
            ->order_by('created_at', 'DESC')
            ->paginate(10, NULL, $pagina);

        $data['atual_paginas'] = $pagina;

        if ($data['registros']) {
            $data['js'] = load_js(array("noticias.js",));
            $data['css'] = load_css(array());

        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('placar/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'link_transmissao'     => @$post['link_transmissao'],
                'nome_campeonato'     => @$post['nome_campeonato'],
                'sigla_dc'   => @$post['sigla_dc'],
                'sigla_vt'      => @$post['sigla_vt'],
                'status_jogo'  => @$post['status_jogo'],
                'gol_dc'  => @$post['gol_dc'],
                'gol_vt'  => @$post['gol_vt'],
                'status' => @$post['status']
            );

            if ($_FILES['arquivo_dono']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo_dono', $this->path);

                if (isset($x_foto['file_name'])) {
                    $dados['brasao_dc'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('placar/formulario/' . $id));
                }
            }
            if ($_FILES['arquivo_visitante']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo_visitante', $this->path);
                if (isset($x_foto['file_name'])) {
                    $dados['brasao_vt'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('placar/formulario/' . $id));
                }
            }

            if ($id) {
                if ($_FILES['arquivo_dono']['error'] === 0) {
                    $placar = $this->Placar_model->get($id);
                    if ($placar) {
                        @unlink($this->path . $placar->brasao_dc);
                    }
                }
                if ($_FILES['arquivo_visitante']['error'] === 0) {
                    $placar = $this->Placar_model->get($id);
                    if ($placar) {
                        @unlink($this->path . $placar->brasao_vt);
                    }
                }
                $this->Placar_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Placar_model->insert($dados);;
                $retorno = '7';
            }
            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('placar/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Placar_model
                ->get($id);
        }

        $data['js'] = load_js(array());
        $data['css'] = load_css(array());

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('placar/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    /*
        public function fotos($id = null)
        {

            //PREDEFINICAO DOS CAMPOS
            $data['fotos'] = $this
                ->Placar_model
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

            $x_imagens = $this->Placar_model->get($post['id']);
            @unlink($this->path . $x_imagens->arquivo);
            $this->Placar_model->delete($post['id']);
        }
*/
    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":
                $galeria = $this->Placar_model->get($id);
                if ($galeria) {
                    @unlink($this->path . $galeria->brasao_dc);
                    unlink($this->path . $galeria->brasao_vt);
                    $this->Placar_model->delete($id);
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

            case "excluir-foto1":
                $galeria = $this->Placar_model->get($id);
                if ($galeria) {
                    @unlink($this->path . $galeria->FOTO);
                    $update = array("brasao" => 'brasao_dc');
                    $this->Placar_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('placar/formulario/' . $id));

                break;

            case "excluir-foto2":
                $galeria = $this->Placar_model->get($id);
                if ($galeria) {
                    @unlink($this->path . $galeria->brasao_vt);
                    $update = array("FOTO" => '');
                    $this->Placar_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('placar/formulario/' . $id));

                break;

        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('esporte'));
    }
    /*
        public function json($id = null, $categoria = null, $pagina = null)
        {
            $infraestrutura = $this
                ->Placar_model
                ->with_fotos()
                ->order_by('nome', 'ASC')
                ->paginate(12, null, $pagina);

            echo json_encode($infraestrutura);
        }
    */
}
