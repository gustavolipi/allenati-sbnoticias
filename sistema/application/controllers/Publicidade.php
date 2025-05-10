<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicidade extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');
        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }
        $this->load->model('Publicidade_model');
        $this->load->model('Publicidade_click_model');
        $this->load->model('Publicidade_pagina_model');

        $this->path = path_upload . 'tickers/publicidade/';
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
            $data['registros'] = $this
                ->Publicidade_model
                ->where('titulo', 'LIKE', @$post['palavra'])
                ->order_by('data_inicio', 'DESC')
                ->paginate(1000000, NULL, $pagina);
        } else {
            $data['registros'] = $this
                ->Publicidade_model
                ->order_by('data_inicio', 'DESC')
                ->paginate(10000000, NULL, $pagina);
        }
        $data['atual_paginas'] = $pagina;
        if ($data['registros']) {
            $data['js'] = load_js(array());
            $data['css'] = load_css(array());
        }
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('publicidade/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = NULL)
    {
        if ($_POST) {
            $post = getPost();
            $dados = array(
                'titulo'      => @$post['titulo'],
                'tipo'        => @$post['tipo'],
                'capa'        => (@$post['capa'] ? 1 : 0),
                'interna'     => (@$post['interna'] ? 1 : 0),
                'esporte'     => (@$post['esporte'] ? 1 : 0),
                'classificados'     => (@$post['classificados'] ? 1 : 0),
                'revistas'     => (@$post['revistas'] ? 1 : 0),
                'podcasts'     => (@$post['podcasts'] ? 1 : 0),
                'tv'     => (@$post['tv'] ? 1 : 0),
                'noticia'     => (@$post['noticia'] ? 1 : 0),
                'data_inicio' => @$post['data_inicio'],
                'data_fim'    => @$post['data_fim'],
                'link'        => @$post['link'],
                'target'      => @$post['target'],
                'codigo'      => @$post['codigo']
            );
            if ($_FILES['arquivo']['error'] === 0) {
                $this->load->library('image_lib');
                $x_foto = do_upload('arquivo', $this->path);
                if (isset($x_foto['file_name'])) {
                    $dados['arquivo'] = $x_foto['file_name'];
                } else {
                    $retorno = '12';
                    $this->session->set_flashdata('retorno', $retorno);
                    redirect(base_url('publicidade/formulario/' . $id));
                }
            }
            if ($id) {
                $this->Publicidade_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Publicidade_model->insert($dados);;
                $retorno = '7';
            }
            $paginas = ['capa', 'interna', 'esporte', 'classificados', 'revistas', 'podcasts', 'tv', 'noticia'];
            foreach ($paginas as $key => $value) {

                $p = $this->Publicidade_pagina_model->where(array(
                    'publicidadeId' => $id,
                    'pagina' => $value
                ))->get();
                
                if($_POST[$value]){
                    if($p){
                        $this->Publicidade_pagina_model->update(array(
                            'publicidadeId' => $id,
                            'pagina' => $value
                        ), $p->id);
                    }
                    else{
                        $this->Publicidade_pagina_model->insert(array(
                            'publicidadeId' => $id,
                            'pagina' => $value
                        ));
                    }
                }
                else{
                    if($p){
                        $this->Publicidade_pagina_model->delete($p->id);
                    }
                }           
            }
            clearCache();

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('publicidade/formulario/' . $id));
        }

        //PREDEFINICAO DOS CAMPOS
        if ($id != NULL) {
            $data['registro'] = $this
                ->Publicidade_model
                ->get($id);
        }

        $data['js'] = load_js(array());
        $data['css'] = load_css(array());
        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('publicidade/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function teste(){
        echo json_encode($this->Publicidade_pagina_model->get_all());
    }

    public function acao($id, $acao)
    {
        switch ($acao) {
            case "excluir":
                $registro = $this->Publicidade_model->get($id);
                if ($registro) {
                    @unlink($this->path . '/' . $registro->arquivo);
                    $this->Publicidade_model->delete($id);
                    $this->Publicidade_click_model->where('publicidade_id', $id)->delete();
                }
                $retorno = '5';
                break;

            case "excluir-foto":
                $galeria = $this->Publicidade_model->get($id);
                if ($galeria) {
                    unlink($this->path . $galeria->arquivo);
                    $update = array("arquivo" => '');
                    $this->Publicidade_model->update($update, $id);
                }

                $retorno = '5';
                $this->session->set_flashdata('retorno', $retorno);
                redirect(base_url('publicidade/formulario/' . $id));

                break;
        }
        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('publicidade'));
    }
}
