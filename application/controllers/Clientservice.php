<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientservice extends CI_Controller 
{

    var $data;
    var $client;

    public function __construct() {

        parent::__construct();
        $this->load->helper("nusoap_helper");
        $this->load->helper("url");
        $this->client = get_nusoap_client(base_url("Webservice/wsdl"));
        //$this->client->soap_defencoding = 'UTF-8';
    }

    public function app_feed()
    {
        //$result = $this->client->call('hello', array('name' => 'Minattinho'));
        //print_r($result);
        //echo "<br>";
        set_nusoap_credentials($this->client,"admin","admin");
        $result = $this->client->call('get_all_itens');
        if($this->client->fault){
            echo "Falha<pre>".var_dump($result)."</pre>";
        }
        else{
            $err = $this->client->getError();
            if($err){
                echo "Erro<pre>".$err."</pre>";
            }else{
                echo "<pre>";
                var_dump(json_decode($result));
                echo "</pre>";
            }
        }
    }
    
    public function create_order()
    {
        set_nusoap_credentials($this->client,"admin","admin");
        $result = $this->client->call('new_order',["pedido"=>'{"itens":[{"qntd":1,"value":4},{"qntd":2,"value":5}],"mesa": 2,"obs":"Essa coca é fanta"}']);
        if($this->client->fault){
            echo "Falha<pre>".var_dump($result)."</pre>";
        }
        else{
            $err = $this->client->getError();
            if($err){
                echo "Erro<pre>".$err."</pre>";
            }else{
                echo "<pre>";
                echo($result);
                echo "</pre>";
            }
        }
        /*echo '<h2>Request</h2>';
        echo '<pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2>';
        echo '<pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
        
        // Display the debug messages
        echo '<h2>Debug</h2>';
        echo '<pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';*/
    }
    
}