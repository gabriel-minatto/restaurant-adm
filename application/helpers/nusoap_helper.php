<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'third_party/nusoap/lib/nusoap.php');

	if(!function_exists('get_nusoap_server'))
	{
		function get_nusoap_server()
		{
			return new soap_server;
		}
	}
	
	if(!function_exists('get_nusoap_client'))
	{
	    function get_nusoap_client($wsdl)
		{
		    $client = new nusoap_client($wsdl);
		    if($client->getError())
		        return "Erro no construtor<pre>".$err."</pre>";
			return $client;
		}
	}
	
	if(!function_exists('set_nusoap_credentials'))
	{
	    function set_nusoap_credentials($client,$login,$senha)
		{
		    if(isset($authHeaders['SessionToken'])){
            $header = '<SessionToken>'. $authHeaders['SessionToken'] .'</SessionToken>';
            $client->setHeaders($header);
            }
            else{
                $client->setCredentials($login,$senha);
            }
		}
	}
	
	if(!function_exists('autenticate_nusoap'))
	{
	    function autenticate_nusoap($login,$senha)
		{
		    if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW'])){
                if ($_SERVER['PHP_AUTH_USER'] == $login && $_SERVER['PHP_AUTH_PW'] == $senha)
                    return true;
                else
                    return false;
            }
            return false;
		}
	}
	
	if(!function_exists('get_postdata'))
	{
	    function get_postdata()
		{
		    return file_get_contents("php://input");
		}
	
	}
	
	if(!function_exists('add_function_to_wsdl'))
	{
	    function add_function_to_wsdl($server,$name,$parameters_in,$return,$description)
		{
		    //$server->configureWSDL($name."wsdl","urn:".$name."wsdl");
            //$server->wsdl->schemaTargetNamespace = "urn:".$name."wsdl";
            
            $server->register($name,
            $parameters_in, //associative array - array("name"=>"xsd:string")
            $return, //associative array - array("return"=>"xsd:string")
            "urn:server",
            "urn:server#".$name,
            "rpc",
            "encoded",
            $description
            );
		}
	}
	
?>