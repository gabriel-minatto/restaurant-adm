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
    
}   




