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
    
    public function create_order(){
        if(!isset($_POST["pedido"])){
            echo "Erro no recebimento do pedido.";
            exit;
        }
        if($_POST["senha"] != "@teste123"){
            echo "Senha incorreta";
            exit;
        }
        $this->load->model("Itens_do_pedido_model","itens_pedido");
        $this->load->model("Pedidos_model","pedido");
        $pedido = (json_decode($this->input->post("pedido",TRUE)));
        $this->pedido->mesa = $pedido->mesa;
        $this->pedido->observacoes = $pedido->obs;
        $this->pedido->status = "waiting";
        
        $this->itens_pedido->pedido = $this->pedido->insert();
        
        foreach($pedido->itens as $item)
        {
            $cont = 0;
            while($cont < $item->qntd){
                $this->itens_pedido->item = $item->value;
                try{
                    $this->itens_pedido->insert();
                }catch(Exception $e){
                    echo "Erro no recebimento do pedido.";
                    exit;
                }
                $cont++;
            }
        }
        echo 1;
    }
    
    public function app_feed(){
        if(!isset($_POST["senha"])){
            echo "Erro no recebimento da senha.";
            exit;
        }
        if($_POST["senha"] != "@teste123"){
            echo "Senha incorreta";
            exit;
        }
        $this->load->model("Itens_model","item");
        echo json_encode($this->item->load_all());
    }
}   




