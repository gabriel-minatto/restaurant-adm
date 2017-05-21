<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller 
{

    var $data;

    public function __construct() {

        parent::__construct();
        
    }

     public function index()
    {
        $this->load->model("Itens_do_pedido_model","itens");
        $pedidos = $this->itens->load_all_waiting();
        $this->data["pedidos"] = [];
        $cont = 0;
        if(isset($pedidos[0])){
            $pedido_id = $pedidos[0]->pedido;
        foreach($pedidos as $key=>$pedido){
            if($pedido->pedido == $pedido_id){
                $this->data["pedidos"][$cont][] = $pedido;
            }else{
                $cont++;
                $this->data["pedidos"][$cont][] = $pedido;
                $pedido_id = $pedidos[$key]->pedido;
            }
        }   
        }
        $this->load->view('kitchen/waiting', $this->data);
    }
    
    public function process($id){
        $this->load->model("Pedidos_model","pedido");
        $this->pedido->id = $id;
        $this->pedido->set_in_process();
        redirect("/sendo-processados", 'refresh');
    }
    
    public function processing(){
        $this->load->model("Itens_do_pedido_model","itens");
        $pedidos = $this->itens->load_all_processing();
        $this->data["pedidos"] = [];
        $cont = 0;
        if(isset($pedidos[0])){
            $pedido_id = $pedidos[0]->pedido;
            foreach($pedidos as $key=>$pedido){
                if($pedido->pedido == $pedido_id){
                    $this->data["pedidos"][$cont][] = $pedido;
                }else{
                    $cont++;
                    $this->data["pedidos"][$cont][] = $pedido;
                    $pedido_id = $pedidos[$key]->pedido;
                }
            }
        }
        $this->load->view('kitchen/processing', $this->data);
    }
    
    public function done($id){
        $this->load->model("Pedidos_model","pedido");
        $this->pedido->id = $id;
        $this->pedido->set_in_deliver();
        redirect("prontos", 'refresh');
    }
    
    public function ready(){
        $this->load->model("Itens_do_pedido_model","itens");
        $pedidos = $this->itens->load_all_ready();
        $this->data["pedidos"] = [];
        $cont = 0;
        if(isset($pedidos[0])){
            $pedido_id = $pedidos[0]->pedido;
            foreach($pedidos as $key=>$pedido){
                if($pedido->pedido == $pedido_id){
                    $this->data["pedidos"][$cont][] = $pedido;
                }else{
                    $cont++;
                    $this->data["pedidos"][$cont][] = $pedido;
                    $pedido_id = $pedidos[$key]->pedido;
                }
            }
        }
        $this->load->view('kitchen/ready', $this->data);
    }
    
    public function deliver($id){
        $this->load->model("Pedidos_model","pedido");
        $this->pedido->id = $id;
        $this->pedido->set_waiting_payment();
        redirect("aguardando-pagamento", 'refresh');
    }
    
    public function waiting_payment(){
        $this->load->model("Itens_do_pedido_model","itens");
        $pedidos = $this->itens->load_all_waiting_payment();
        $this->data["pedidos"] = [];
        $cont = 0;
        if(isset($pedidos[0])){
            $pedido_id = $pedidos[0]->pedido;
            foreach($pedidos as $key=>$pedido){
                if($pedido->pedido == $pedido_id){
                    $this->data["pedidos"][$cont][] = $pedido;
                }else{
                    $cont++;
                    $this->data["pedidos"][$cont][] = $pedido;
                    $pedido_id = $pedidos[$key]->pedido;
                }
            }
        }
        $this->load->view('kitchen/waiting_payment', $this->data);
    }
    
    public function finish($id){
        $this->load->model("Pedidos_model","pedido");
        $this->pedido->id = $id;
        $this->pedido->set_finished();
        redirect("finalizados", 'refresh');
    }
    
    public function finished(){
        $this->load->model("Itens_do_pedido_model","itens");
        $pedidos = $this->itens->load_all_finished();
        $this->data["pedidos"] = [];
        $cont = 0;
        if(isset($pedidos[0])){
            $pedido_id = $pedidos[0]->pedido;
            foreach($pedidos as $key=>$pedido){
                if($pedido->pedido == $pedido_id){
                    $this->data["pedidos"][$cont][] = $pedido;
                }else{
                    $cont++;
                    $this->data["pedidos"][$cont][] = $pedido;
                    $pedido_id = $pedidos[$key]->pedido;
                }
            }
        }
        $this->load->view('kitchen/finished', $this->data);
    }
    
    public function item_management(){
        $this->load->view('kitchen/item_management', $this->data);
    }
    
    
}   




