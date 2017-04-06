<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller 
{

    var $data;

    public function __construct() {

        parent::__construct();
        
    }

     public function index()
    {
        $this->load->view('kitchen/waiting', $this->data);
    }
    
    public function loading(){
        $this->load->view('kitchen/loading', $this->data);
    }
    
    public function ready(){
        $this->load->view('kitchen/ready', $this->data);
    }
    
    public function waiting_payment(){
        $this->load->view('kitchen/waiting_payment', $this->data);
    }
    
    public function finished(){
        $this->load->view('kitchen/finished', $this->data);
    }
    
    public function create_order(){
        if(!isset($_POST["pedido"])){
            echo "Erro no recebimento do pedido.";
            exit;
        }
        $pedido = (json_decode($this->input->post("pedido",TRUE)));
        if(!isset($pedido->senha) || $pedido->senha != "@teste123"){
            echo "Senha incorreta";
            exit;
        }
        $this->load->model("Itens_do_pedido_model","itens_pedido");
        $this->load->model("Pedidos_model","pedido");
        
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
        $senha = (json_decode($this->input->post("senha",TRUE)));
        if(!isset($pedido->senha) || $pedido->senha != "@teste123"){
            echo "Senha incorreta";
            exit;
        }
    }
}   




