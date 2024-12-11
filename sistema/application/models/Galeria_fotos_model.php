<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Galeria_fotos_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'GALERIASLEGENDA';
		$this->primary_key = 'id';
		$this->has_one['galeria'] = array('Galeria_model', 'id', 'galeria');

		parent::__construct();
	}
}
/* End of file '/User_model.php' */
/* Location: ./application/models//User_model.php */
