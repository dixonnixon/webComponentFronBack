<?php
namespace DomainModel;

class Request {
    private $request = [];

    public function __construct($method=null, $server=null, $param=[]) 
    {
        $this->request = $this->initFromHttp($param);
        if(!$method) {
            $method = $_SERVER["REQUEST_METHOD"];
        }

        if(!$server) {
            $server = $_SERVER["SERVER_ADDR"];
        }

        $method = __NAMESPACE__ . '\\' . ucFirst(strToLower($method));
        $this->server = trim(strToLower($server));

        $this->type = new $method($this);
    }

    function getServer()
    {
        return $this->server;
    }

    private function initFromHttp($param=[]) 
    {
        if (!empty($_POST)) return $_POST;
        if (!empty($_GET))  return $_GET;
        if (!empty($_PUT))  return $_PUT;
        return $param;
    }

    function getParameters()
    {
        return $this->get("par");
    }

    public function get($name) 
    {
        if (!array_key_exists($name, $this->request)) return '';
        return $this->request[$name];
    }

    function getType()
    {
        return $this->type;
    }

    public function set($name,$value) 
    {
        $this->request[$name] = $value;
    }
}



?>