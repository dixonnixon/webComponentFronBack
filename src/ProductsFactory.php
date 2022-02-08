<?php
declare(strict_types=1);

namespace DomainModel;

class ProductsFactory
{
    public static function factory(string $type) 
    {
        $type = null;
        switch($type) {
            case "wordProcessor":
                $type = new Product($type, new Complete());
                break;
            case "spreadsheet":
                $type = new Product($type, new ThreeWay(60, 90));
                break;
            case "database":
                $type = new Product($type, new ThreeWay(30, 90));
                break;
            default:    
                throw new InvalidArgumentException('Unknown product_name given');
                break;
        }

        return $type;
    }
}