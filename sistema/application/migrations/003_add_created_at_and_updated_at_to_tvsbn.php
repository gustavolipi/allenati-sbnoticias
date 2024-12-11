<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_created_at_and_updated_at_to_tvsbn extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        if (!$this->db->field_exists(array('created_at', 'updated_at'), 'tvsbn')) {
        $fields = array(
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => true
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => true
            )
        );
        $this->dbforge->add_column('tvsbn', $fields);
    }
    }

    public function down()
    {
        $this->dbforge->drop_column('tvsbn', 'created_at');
        $this->dbforge->drop_column('tvsbn', 'updated_at');
    }
}