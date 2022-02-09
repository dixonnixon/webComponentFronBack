<?php
use PHPUnit\Framework\TestCase;

use Portal\Builder;
use sys\UniversalConnect;
use DomainModel\Request;


class LoginTest extends TestCase
{
    protected $ds;
    protected $req;

    protected function setUp(): void
    {
        $this->ds = UniversalConnect::doConnect('test');
        $this->req = new Request("GET", $_ENV['HOST_IP'], [
            
        ]);
    }

    function testConnection() 
    {
        $this->assertInstanceOf('\PDO', $this->ds);
    }

    function testLogin()
    {

    }
}

?>