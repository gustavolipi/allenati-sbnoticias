<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_created_at_and_updated_at_to_galeriaslegenda extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->field_exists(array('created_at', 'updated_at'), 'GALERIASLEGENDA')) {
            $fields = array(
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column('GALERIASLEGENDA', $fields);
        }
    }

    public function down()
    {
        $this->dbforge->drop_column('GALERIASLEGENDA', 'created_at');
        $this->dbforge->drop_column('GALERIASLEGENDA', 'updated_at');
    }
}