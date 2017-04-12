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
        $this->client->soap_defencoding = 'UTF-8';
    }

    public function index()
    {
        set_nusoap_credentials($this->client,"admin","admin");
        $result = $this->client->call('hello', array('name' => 'Minattinho'));
        print_r($result);
        echo "<br>";
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
    
}   



