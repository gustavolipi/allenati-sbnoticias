<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_publicidade extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->table_exists('publicidade')) {
            $this->dbforge->add_field(array(
                'id'         => array(
                    'type'           => 'INT',
                    'constraint' => 11,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
                ),
                'titulo'    => array(
                    'type'       => 'VARCHAR',
                    'constraint' => '100'
                ),
                'tipo'    => array(
                    'type'       => 'INT',
                    'constraint' => '1'
                ),
                'capa'    => array(
                    'type'       => 'INT',
                    'constraint' => '1'
                ),
                'interna'    => array(
                    'type'       => 'INT',
                    'constraint' => '1'
                ),
                'esporte'    => array(
                    'type'       => 'INT',
                    'constraint' => '1'
                ),
                'link'    => array(
                    'type'       => 'LONGTEXT',
                    'null' => true
                ),
                'target'    => array(
                    'type'       => 'VARCHAR',
                    'constraint' => '20',
                    'null' => true
                ),
                'arquivo'    => array(
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ),
                'codigo'    => array(
                    'type'       => 'LONGTEXT'
                ),
                'data_inicio' => array(
                    'type' => 'DATE'
                ),
                'data_fim' => array(
                    'type' => 'DATE',
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
            $this->dbforge->create_table('publicidade');
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('publicidade');
    }
}