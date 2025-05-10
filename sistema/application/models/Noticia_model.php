<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Noticia_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'NOTICIASGERAL';
        $this->primary_key = 'id';

        parent::__construct();
    }

    public function getNoticias($where)
    {

        $query = 'SELECT';
        $query .= ' ID, DATA, HORA, FOTO, FOTOCAPA, TIPO, CATEGORIA, TITULO, FONTE, CHAMADA, CONTEUDO, CAST(DATE_FORMAT(CONCAT(DATA," ", HORA), "%Y-%m%-%d %H:%i:%s") AS DATETIME) as DATACOMPLETA ';
        $query .= ' FROM ' . $this->table . ' ';
        $query .= ' WHERE CAST(DATE_FORMAT(CONCAT(DATA," ", HORA), "%Y-%m%-%d %H:%i:%s") AS DATETIME) <= NOW() ';
        if (isset($where['prioridade']) && $where['prioridade'] == 1) {
            $query .= ' AND PRIORIDADE = 1 ';
        }

        if (isset($where['tipo']) && $where['tipo'] == 'esportes') {
            $query .= " AND TIPO = 'esportes' ";
        }else{
            $query .= " AND TIPO != 'esportes' ";
        }

        if (isset($where['foto']) && $where['foto'] == 1) {
            $query .= ' AND FOTO != ""';
        }
        $query .= ' ORDER BY DATACOMPLETA DESC ';
        if (isset($where['limite']) && $where['limite']) {
            $query .= ' LIMIT ' . $where['limite'];
            if (isset($where['pagina']) && $where['pagina']) {
                $query .= ' ' . $where['pagina'] * 20;
            }
        }

        $resultado = $this->db->query($query);

        return $resultado->result();
    }

}
/* End of file '/User_model.php' */
/* Location: ./application/models//User_model.php */
