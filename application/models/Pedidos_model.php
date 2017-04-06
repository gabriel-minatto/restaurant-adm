<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model
{
    var $id;
    var $mesa;
    var $observacoes;
    var $data;
    var $status;
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function insert()
    {
        $this->db->insert("pedidos", $this);
        return $this->db->insert_id();
    }
    
    public function delete()
    {
        $this->db->where("id", $this->id);
        $this->db->delete("pedidos");
    }
    
    public function load_by_id()
    {
    	$sql = "select * from pedidos where id=?";
    	$query = $this->db->query($sql, array($this->id_usuario));
        return $query->row(0, "Pedidos_model");
    }
    
    public function set_in_process(){
        $this->db->where("id",$this->id);
        $this->db->set("status","processing");
        $this->db->update("pedidos");
        return $this->db->trans_status();
    }
    
    public function set_in_deliver(){
        $this->db->where("id",$this->id);
        $this->db->set("status","ready");
        $this->db->update("pedidos");
        return $this->db->trans_status();
    }
    
    public function set_waiting_payment(){
        $this->db->where("id",$this->id);
        $this->db->set("status","waiting_payment");
        $this->db->update("pedidos");
        return $this->db->trans_status();
    }
    
    public function set_finished(){
        $this->db->where("id",$this->id);
        $this->db->set("status","finished");
        $this->db->update("pedidos");
        return $this->db->trans_status();
    }
    
}