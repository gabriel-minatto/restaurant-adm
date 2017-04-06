<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itens_model extends CI_Model
{
    var $id;
    var $nome;
    var $preco;
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function insert()
    {
        $this->db->insert("itens", $this);
        return $this->db->insert_id();
    }
    
    public function delete()
    {
        $this->db->where("id", $this->id);
        $this->db->delete("itens");
    }
    
    public function load_by_id()
    {
    	$sql = "select * from itens where id=?";
    	$query = $this->db->query($sql, array($this->id_usuario));
        return $query->row(0, "Itens_model");
    }
    
	
}

?>