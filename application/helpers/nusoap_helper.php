<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'third_party/nusoap/lib/nusoap.php');

    if(!function_exists('configure_wsdl_file')) //instancia um servidor
	{
		function configure_wsdl_file($server,$name) //configura o arquivo wsdl e seta um nome para schema
		{
		    $server->configureWSDL($name, 'urn:'.$name);
            $server->wsdl->schemaTargetNamespace = 'urn:'.$name;
		}
	}

	if(!function_exists('get_nusoap_server')) //instancia um servidor
	{
		function get_nusoap_server()
		{
			return new soap_server;
		}
	}
	
	if(!function_exists('get_nusoap_client'))//instancia um client/consumer
	{
	    function get_nusoap_client($wsdl)
		{
		    $client = new nusoap_client($wsdl);
		    if($client->getError())
		        return "Erro no construtor<pre>".$err."</pre>";
			return $client;
		}
	}
	
	if(!function_exists('set_nusoap_credentials')) //faz "login" nmum webservice
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
	
	if(!function_exists('autenticate_nusoap')) //verifica se o usuario esta "logado"
	{
	    function autenticate_nusoap($login,$senha)
		{
			//$headers = getallheaders();
			$headers = apache_request_headers();
			
			if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
                if ($_SERVER['PHP_AUTH_USER'] == $login && $_SERVER['PHP_AUTH_PW'] == $senha)
                    return true;
            
			
			if (isset($_SERVER['php_auth_user']) && isset($_SERVER['php_auth_pw']))
                if ($_SERVER['php_auth_user'] == $login && $_SERVER['php_auth_pw'] == $senha)
                    return true;
			
		    if (isset($headers['php_auth_user']) && isset($headers['php_auth_pw']))
                if ($headers['php_auth_user'] == $login && $headers['php_auth_pw'] == $senha)
                    return true;

            return false;
		}
	}
	
	if(!function_exists('get_postdata')) //retorna o postdata
	{
	    function get_postdata()
		{
		    return file_get_contents("php://input");
		}
	
	}
	
	if(!function_exists('add_function_to_wsdl')) //adicionada funcoes ao webservice
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