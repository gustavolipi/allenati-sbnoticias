<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_created_at_and_updated_at_to_artigo extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->field_exists('created_at', 'ARTIGOS')) {
            $fields = array(
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column('ARTIGOS', $fields);
        }
        if (!$this->db->field_exists('updated_at', 'ARTIGOS')) {
            $fields = array(
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column('ARTIGOS', $fields);
        }
    }


    public function down()
    {
        $this->dbforge->drop_column('ARTIGOS', 'created_at');
        $this->dbforge->drop_column('ARTIGOS', 'updated_at');
    }
}