<?php
require __DIR__ . '/../vendor/autoload.php';

// use DomainModel\Product;
use Portal\Builder;
use DomainModel\Request;

echo "<pre>";
var_dump($_SERVER);
// var_dump($_ENV);
echo "</pre>";

// $word = Product::wordProcessor("thinking Word");
// var_dump($word);

//каркас для отображение главной страницы порталов
//  -   шапка:
//          подгрузка структуры портала в зависимости от типа

// var_dump($_ENV);


/**
 * Example Use
 */
Facade::create();
new sys\ConnectionFac();

$host = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];

// define('APP_URL', (isSecure() ? 'https' : 'http') . "://{$host}".str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
// echo APP_URL;

// [] check isSecure() -> true: create Secure obj. Call method  ->handle() to handle SSL
        // ->false: create Rocky obj. Call method ->handle() to handle other requests

class Facade
{
    function __construct() 
    {
        $request = new Request("GET", $_ENV['HOST_IP']);


        $app = new Builder([
            "interface" => "web",
            "type" => "crm",
            "publicEntry" => "index.html",
            "scripts" => [
                "path"=> "public/js/"
            ],
            
        ]);

        $app->make([
            "rewrite" => true,
            "scripts" => [
                "list" => [
                    ["name" => "app", "type" => "module" ],
                    ["name" => "index", "type" => "text/javascript" ]
                ]
            ]
        ], $request);



        $app->render();
    }

    static function create()
    {
        return new self();
    }
}



// phpinfo();
//fALSE TEST ChANGES IN SUBMODULE
?>