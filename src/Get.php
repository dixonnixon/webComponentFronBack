<?php
namespace DomainModel;


class Get extends Receiver
{
    protected $methods = [];


    //logic of parsing parameters encapsulated here
    function specify(Array $params)
    {
        var_dump("methods", $this->methods, $params);
        $result = null;

        if(empty($params[0]))
        {
            $result = [$this->methods[2], []];
        }

        if(is_numeric($params[0]))
        {
            $result =  [$this->methods[1], $params];
        }

        
        if(!$result)
        {
            throw new \Exception("no valid parameters passed {$params[0]}");
        }

        var_dump($result);

        return $result;
    }
}

?>