<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MY_Controller
{

    function __construct()
    {
        parent::__construct();;
        $this->load->model('Usuario_model');

        $this->login = $this->session->userdata('login');

    }

    public function index()
    {

        if($this->login['nivel'] != 'M'){
            redirect(base_url());
        }

        $data['login_tipo'] = $this->login['nivel'];

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $usuarios = $this
            ->Usuario_model
            ->order_by("nome", "ASC")
            ->get_all();
        if ($usuarios) {
            $data['usuarios'] = $usuarios;
        }

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php');
        $this->load->view('usuarios/lista.php', @$data);
        $this->load->view('templates/footer.php');
    }

    public function formulario($id = null)
    {

        $data['id'] = $id;
        $data['post'] = getPost();

        if($this->login['nivel'] != 'M'){
            if($id != $this->login['id']) {
                redirect(base_url());
            }
        }

        if ($_POST) {

            $post = getPost();

            $dados = array(
                'nome' => $post['nome'],
                'email' => $post['email'],
                'ativo' => $post['ativo'],
                'nivel' => $post['tipo']
            );

            if($this->login['nivel'] == 'E' || $this->login['nivel'] == 'G'){
                unset($dados['ativo']);
                unset($dados['nivel']);
            }

            if (isset($post['senha'])) {
                $dados['senha'] = md5($post['senha']);
            }

            if ($id) {
                $this->Usuario_model->update($dados, $id);
                $retorno = '6';
            } else {
                $id = $this->Usuario_model->insert($dados);
                $retorno = '7';
            }

            $this->session->set_flashdata('retorno', $retorno);
            redirect(base_url('usuarios/formulario/' . $id));
        }

        if ($id != null) {

            $data['usuario'] = $this
                ->Usuario_model
                ->where(@$where)
                ->get($id);
            if (!$data['usuario']) {
                redirect(base_url('eventos'));
            }
        }

        $data['cmp_ativo'] = array("" => "-- Selecione o Status --", "1" => "Ativo", "0" => "Inativo");
        $data['cmp_tipo'] = array("" => "-- Selecione o Tipo --", "M" => "Master", "E" => "Editor", "G" => "Galeria de Fotos");

        $data['js'] = load_js(array());

        $data['css'] = load_css(array());

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('templates/header.php', @$data);
        $this->load->view('templates/lateral.php', @$data);
        $this->load->view('usuarios/formulario', @$data);
        $this->load->view('templates/footer.php', @$data);

    }

    public function acao($id, $acao)
    {

        switch ($acao) {
            case "excluir":

                $usuario = $this->Usuario_model->get($id);

                if ($usuario) {
                    $this->Usuario_model->delete($id);

                }

                $retorno = '5';

                break;


        }

        $this->session->set_flashdata('retorno', $retorno);
        redirect(base_url('usuarios'));

    }

}
