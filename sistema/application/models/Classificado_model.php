<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Classificado_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'CLASSIFICADOS';
        $this->primary_key = 'id';

		$this->has_one['categoria'] = array('Categorias_model', 'id', 'CATEGORIA_ID');

		parent::__construct();
	}
}
/* End of file '/User_model.php' */
/* Location: ./application/models//User_model.php */
