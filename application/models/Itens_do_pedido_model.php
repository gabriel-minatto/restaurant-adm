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
    
    public function load_all_waiting()
    {
        $this->db->from("itens_do_pedido idp");
        $this->db->join("pedidos p","p.id = idp.pedido");
        $this->db->join("itens i","i.id = idp.item");
        $this->db->where("p.status","waiting");
        $this->db->where("i.disponibilidade","1");
        $this->db->order_by("idp.pedido","asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function load_all_processing()
    {
        $this->db->from("itens_do_pedido idp");
        $this->db->join("pedidos p","p.id = idp.pedido");
        $this->db->join("itens i","i.id = idp.item");
        $this->db->where("p.status","processing");
        $this->db->where("i.disponibilidade","1");
        $this->db->order_by("idp.pedido","asc");
        $query = $this->db->get();
        return $query->result();
    }
    
	public function load_all_ready()
    {
        $this->db->from("itens_do_pedido idp");
        $this->db->join("pedidos p","p.id = idp.pedido");
        $this->db->join("itens i","i.id = idp.item");
        $this->db->where("p.status","ready");
        $this->db->where("i.disponibilidade","1");
        $this->db->order_by("idp.pedido","asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function load_all_waiting_payment()
    {
        $this->db->from("itens_do_pedido idp");
        $this->db->join("pedidos p","p.id = idp.pedido");
        $this->db->join("itens i","i.id = idp.item");
        $this->db->where("p.status","waiting_payment");
        $this->db->where("i.disponibilidade","1");
        $this->db->order_by("idp.pedido","asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function load_all_finished()
    {
        $this->db->from("itens_do_pedido idp");
        $this->db->join("pedidos p","p.id = idp.pedido");
        $this->db->join("itens i","i.id = idp.item");
        $this->db->where("p.status","finished");
        $this->db->where("i.disponibilidade","1");
        $this->db->order_by("idp.pedido","asc");
        $query = $this->db->get();
        return $query->result();
    }
    
}

?>