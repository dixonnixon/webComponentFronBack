<?php
namespace sys;
abstract class ConnectionCreator
{
    abstract public function handle();

    function execute() 
    {
        
        $this->handle();
    }
}
?>