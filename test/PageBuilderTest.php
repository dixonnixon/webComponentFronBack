<?php
use PHPUnit\Framework\TestCase;

use Portal\Builder;
use DomainModel\Request;


class PageBuilderTest extends TestCase
{
    function testBuilderProductPage()
    {
        $request = new Request("GET", $_ENV['HOST_IP']);

        $app = new Builder([
            "interface" => "web",
            "type" => "crm",
            "scriptsPath" => "public/js/",
            "publicEntry" => "index.html"
        ]);

        $dom = $app->make([
            "rewrite" => true,
            "scripts" => [
                "list" => [
                    ["name" => "app", "type" => "module" ],
                    ["name" => "index", "type" => "text/javascript" ]
                ]
            ]
        ], $request);

        // var_dump($dom);
        $this->assertTrue(is_file(dirname(__FILE__) . '/../index.html'));

        //file has  scriptTags
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: ua\r\n"
            )
        );
            
        $context = stream_context_create($opts);

        //test file has scriptTags
        foreach(DOMDocument::loadHTMLFile(dirname(__FILE__) . '/../index.html')->getElementsByTagName('script')     
            as $el) {
                $this->assertInstanceOf('\DOMElement', $el);
                
        }

        //test url has scriptTags
        foreach(DOMDocument::loadHTML(file_get_contents($app->getUrl(), false, $context))->getElementsByTagName('script')
            as $el) {
            $this->assertInstanceOf('\DOMElement', $el);
        }
    }
}
?>