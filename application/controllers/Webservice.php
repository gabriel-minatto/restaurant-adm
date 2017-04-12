<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebService extends CI_Controller 
{

    var $data;
    var $server;

    public function __construct() {

        parent::__construct();
        $this->load->helper("nusoap_helper");
        $this->server = get_nusoap_server();
        $this->server->configureWSDL('server', 'urn:server');
        $this->server->wsdl->schemaTargetNamespace = 'urn:server';
        add_function_to_wsdl($this->server,"hello",["name"=>"xsd:string"],["return"=>"xsd:string"],"Retorna o nome do rapaz");
        add_function_to_wsdl($this->server,"get_all_itens",[],["return"=>"xsd:string"],"Retorna um json com todos os itens cadastrados.");
    }

    public function index()
    {
        if($this->uri->rsegment(3) == "wsdl") {
            $_SERVER['QUERY_STRING'] = "wsdl";
        } else {
            $_SERVER['QUERY_STRING'] = "";
        } 
        
        function hello($name){
            if (!autenticate_nusoap("admin","admin"))
                return 'Erro de autenticacao.';
            return "Hello ".$name;
        }
        
        function get_all_itens(){
            if (!autenticate_nusoap("admin","admin"))
                return 'Erro de autenticacao.';
            $CI =& get_instance();
		    $CI->load->model("Itens_model","itens");
		    return (string)json_encode($CI->itens->load_all());
        }
        $this->server->service(get_postdata());
    }
}