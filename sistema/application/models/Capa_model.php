<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Capa_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'destaque';
		$this->primary_key = 'id';

		parent::__construct();
	}
}
/* End of file '/User_model.php' */
/* Location: ./application/models//User_model.php */
