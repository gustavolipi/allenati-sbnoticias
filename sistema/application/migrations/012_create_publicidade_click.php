<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_publicidade_click extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->table_exists('publicidade_click')) {
            $this->dbforge->add_field(array(
                'id'         => array(
                    'type'           => 'INT',
                    'constraint' => 11,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
                ),
                'publicidade_id'    => array(
                    'type'       => 'INT',
                    'constraint' => '11',
                    'null' => false
                ),
                'ip'    => array(
                    'type'       => 'LONGTEXT',
                    'null' => true
                ),
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            ));

            $this->dbforge->add_key('id');
            $this->dbforge->create_table('publicidade_click');
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('publicidade_click');
    }
}