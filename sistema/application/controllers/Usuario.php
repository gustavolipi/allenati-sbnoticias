<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    public function index()
    {
        if ($_POST) {

            $this->load->model('Usuario_model');
            $post = getPost();

            $data['tipo'] = $post['acao'];

            if ($post['acao'] === 'logar') {

                if (@$post['email'] && @$post['senha']) {

                    $where = array(
                        'ativo' => '1',
                        'email' => $post['email'],
                        'senha' => md5($post['senha']),
                    );

                    $login = $this->Usuario_model
                        ->where($where)
                        ->get();

                    if ($login) {

                        $newdata['login'] = array(
                            'id'        => $login->id,
                            'nome'      => $login->nome,
                            'email'     => $login->email,
                            'tipo'      => $login->tipo,
                            'logged_in' => TRUE,
                        );
                        $this->session->set_userdata($newdata);

                        redirect('dashboard', 'refresh');

                    } else {
                        $retorno = '1';
                    }

                } else {
                    $retorno = '2';
                }

            } else {

                if (@$post['email']) {

                    $where = array(
                        'ativo' => '1',
                        'email' => $post['email'],
                    );

                    $login = $this->Usuario_model
                        ->where($where)
                        ->get();

                    if ($login) {

                        $data['nome_usuario'] = $login->nome;
                        $data['senha'] = gerar_senha();

                        //$retorno = mailSend($data, 'recuperar_senha', 'Uma nova senha foi gerada', 'Gerenciador de Eventos', 'gustavolipi@gmail.com', $login->email, $bcc = true);

                        if ($retorno == '201') {
                            $update_data = array('senha' => md5($data['senha']));
                            $this->Usuario_model->update($update_data, $login->id);
                            $retorno = '10';
                        } else {
                            $retorno = '11';
                        }

                    } else {
                        $retorno = '9';
                    }

                } else {
                    $retorno = '8';
                }

            }

            $this->session->unset_userdata('login');
            if (@$retorno) {
                $this->session->set_flashdata('retorno', $retorno);
            }

        }

        $data['msg_retorno'] = msg_retorno($this->session->flashdata('retorno'));

        $this->load->view('usuario.php', $data);

    }


    public
    function logout()
    {

        $this->session->unset_userdata('login');
        redirect('usuario', 'refresh');

    }
}
