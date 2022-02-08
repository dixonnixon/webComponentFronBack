<?php
namespace DomainModel;

abstract class Receiver
{
    protected $par;

    function methods(): void
    {
        $reflection = new \ReflectionClass(Retrieve::class);

        array_map([$this, 'setMethod'],
            $reflection->getMethods());
        
        // var_dump("</b></pre>");
    }

    function setMethod($el) {
        // var_dump($this->methods, "name", $el->name);
        array_push($this->methods, $el->name);
    }

    function __construct($req)
    {
        $this->par = $req->getParameters();
        $this->methods();
    }

    // abstract function  methods(): void ;
    abstract function specify(Array $params);

    function getRequestParameters()
    {
        return $this->par;
    }
}

?>