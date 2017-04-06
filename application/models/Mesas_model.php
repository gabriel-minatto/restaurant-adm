<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mesas_model extends CI_Model
{
    var $id;
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function insert()
    {
        $this->db->insert("mesas", $this);
        return $this->db->insert_id();
    }
    
    public function delete()
    {
        $this->db->where("id", $this->id);
        $this->db->delete("mesas");
    }
    
    public function load_by_id()
    {
    	$sql = "select * from mesas where id=?";
    	$query = $this->db->query($sql, array($this->id_usuario));
        return $query->row(0, "Mesas_model");
    }
    
	
}

?>