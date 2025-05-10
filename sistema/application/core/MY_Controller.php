<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //VERIFICA SE O USUARIO ESTA LOGADO
        $login = $this->session->userdata('login');

        if ($login['logged_in'] != TRUE) {
            redirect(base_url('login'));
        }
        $url = $this->uri->segment(1);

        if (($login['nivel'] == 'E' || $login['nivel'] == 'EA')) {
            if ($url) {
                if ($url != 'aconteceaqui' && $url != 'aprovados' && $url != 'dashboard' && $url != '') {
                    redirect(base_url('login'));
                }
            }
        }

        if (($login['nivel'] == 'G')) {
            if ($url) {
                if ($url != 'galeria' && $url != 'dashboard' && $url != '') {
                    redirect(base_url('login'));
                }
            }
        }
    }
}
