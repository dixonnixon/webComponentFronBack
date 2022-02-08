<?php
use PHPUnit\Framework\TestCase;

use Portal\Builder;
use sys\UniversalConnect;


class LoginTest extends TestCase
{
    protected $ds;

    protected function setUp(): void
    {
        $this->ds = UniversalConnect::doConnect('test');
    }

    function testConnection() 
    {
        $this->assertInstanceOf('\PDO', $this->ds);
    }
}

?>