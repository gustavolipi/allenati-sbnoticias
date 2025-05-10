<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_midia extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->table_exists('midia')) {
            $this->dbforge->add_field(array(
                'id'         => array(
                    'type'           => 'INT',
                    'constraint' => 11,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
                ),
                'arquivo'    => array(
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
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
            $this->dbforge->create_table('midia');
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('midia');
    }
}