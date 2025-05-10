<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_created_at_and_updated_at_to_placar extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->field_exists('created_at', 'placar')) {
            $fields = array(
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column('placar', $fields);
        }
        if (!$this->db->field_exists('updated_at', 'placar')) {
            $fields = array(
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column('placar', $fields);
        }
    }


    public function down()
    {
        $this->dbforge->drop_column('placar', 'created_at');
        $this->dbforge->drop_column('placar', 'updated_at');
    }
}