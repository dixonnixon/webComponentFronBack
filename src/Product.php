<?php
namespace DomainModel;

use Money\Money;
use Money\Currency;

class Product
{
    private $name;
    private $strategy;

    function __construct($name, $strategy)
    {
        $this->name = $name;
        $this->strategy = $strategy;
    }

    static function  wordProcessor($name)
    {
        return new Product($name, new Complete());
    }
    static function spreadsheet($name)
    {
        return new Product($name, new ThreeWay(60, 90));
    }
    static function database($name)
    {
        return new Product($name, new ThreeWay(30, 60));
    }

    function calculateRevenueDefinitions(Contract $contract)
    {
        $this->strategy->calculateRevenues($contract);
    }
}

?>