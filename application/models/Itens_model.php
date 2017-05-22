<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itens_model extends CI_Model
{
    var $id;
    var $nome;
    var $preco;
    var $disponibilidade;
    var $tipo;
    
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
    
	public function load_all(){
	    $this->db->from("itens");
	    $query = $this->db->get();
	    return $query->result();
	}
	
	public function load_all_available(){
	    $this->db->from("itens");
	    $this->db->where("disponibilidade",1);
	    $query = $this->db->get();
	    return $query->result();
	}
	
	public function enable_availability(){
	    $this->db->set('disponibilidade', 1);
        $this->db->where('id', $this->id);
        $this->db->update('itens');
	}
	
	public function unable_availability(){
	    $this->db->set('disponibilidade', 0);
        $this->db->where('id', $this->id);
        $this->db->update('itens');
	}
}
