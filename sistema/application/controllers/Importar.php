<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importar extends MY_Controller
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
        $this->load->model('Memorias_model');
    }

    public function fotosNoticias(){
        set_time_limit(0);
        ini_set("memory_limit",-1);
        $base_foto_original = "/home/sbnot691/public_html/2018/tickers/imagens/";

        $todasnoticias = $this->Noticia_model->where('importou_img', '2')->limit(10000)->order_by('RAND()')->get_all();

        if($todasnoticias){
            foreach ($todasnoticias as $item => $value){

                echo $base_foto_original . 'img_' . $value->ID . '_orig.jpg';
                echo "<br>";
                echo file_exists($base_foto_original . 'img_' . $value->ID . '_orig.jpg');
                echo "<br>";
                echo "<hr>";

                if(file_exists($base_foto_original . 'img_' . $value->ID . '_orig.jpg')){
                    $update['FOTO'] = 'img_' . $value->ID . '_orig.jpg';
                }else{
                    $update['FOTO'] = null;
                }

                $update['importou_img'] = '3';
                $this->Noticia_model->update($update, $value->ID);
            }
        }
    }

    public function fotosMemorias(){
        set_time_limit(0);
        ini_set("memory_limit",-1);
        $base_foto_original = "/home/sbnot691/public_html/2018/tickers/sbmemorias/imagens/";
        echo $base_foto_original;
        $todasnoticias = $this->Memorias_model->where('importou_img', '2')->limit(10000)->order_by('RAND()')->get_all();

        if($todasnoticias){
            foreach ($todasnoticias as $item => $value){
                if(file_exists($base_foto_original . $value->ID . '.jpg')){
                    $update['FOTO'] = $value->ID . '.jpg';
                }

                $update['importou_img'] = '3';
                $this->Memorias_model->update($update, $value->ID);
            }
        }
    }
}
