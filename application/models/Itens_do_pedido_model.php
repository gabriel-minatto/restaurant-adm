<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itens_do_pedido_model extends CI_Model
{
    var $id;
    var $item;
    var $pedido;
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function insert()
    {
        $this->db->insert("itens_do_pedido", $this);
        return $this->db->insert_id();
    }
    
    public function delete()
    {
        $this->db->where("id", $this->id);
        $this->db->delete("itens_do_pedido");
    }
    
    public function load_by_id()
    {
    	$sql = "select * from itens_do_pedido where id=?";
    	$query = $this->db->query($sql, array($this->id_usuario));
        return $query->row(0, "Itens_do_pedido_model");
    }
    
	
}

?>