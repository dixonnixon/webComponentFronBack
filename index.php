<?php
require __DIR__ . '/../vendor/autoload.php';

// use DomainModel\Product;
use Portal\Builder;
use DomainModel\Request;

// $word = Product::wordProcessor("thinking Word");
// var_dump($word);

//каркас для отображение главной страницы порталов
//  -   шапка:
//          подгрузка структуры портала в зависимости от типа

// var_dump($_ENV);

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
// phpinfo();
?>