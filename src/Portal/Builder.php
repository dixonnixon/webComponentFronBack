<?php
namespace Portal;

use DomainModel\Request;

class Builder
{
    function __construct($opts)
    {
        $this->indexFile = $opts["publicEntry"];
        $this->indexUrl = null;

        $this->dom = new \DOMDocument('1.0', 'utf-8');
        $this->scriptsPath = $opts["scripts"]["path"];

        $root = $this->dom->createElement('html');
        $root = $this->dom->appendChild($root);

        $head = $this->dom->createElement('head');
        $head = $root->appendChild($head);

        $link = $this->dom->createElement('link');
        $link->setAttribute("rel", "stylesheet");
        $link->setAttribute("href", "public/css/index.css");
        $link = $head->appendChild($link);

        $this->body = $this->dom->createElement('body');
        $this->body = $root->appendChild($this->body);  

        $title = $this->dom->createElement('title');
        $title = $head->appendChild($title);

        $text = $this->dom->createTextNode('Это заголовок');
        $text = $title->appendChild($text);
    }

    function make($opts, Request $req) 
    {
        array_map([$this, 'makeScript'], $opts["scripts"]["list"]);

        $output = $this->dom->saveXML();

        stream_context_set_default(
            array(
                'http' => array(
                    'method' => 'HEAD'
                )
            )
        );

        // $this->indexUrl = "http://{$_SERVER['SERVER_ADDR']}/domainModel/{$this->indexFile}";
        $this->indexUrl = "http://{$req->server}/domainModel/{$this->indexFile}";
        $headers = get_headers($this->indexUrl, true);

        //------------is404
        $handle = curl_init($this->indexUrl);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    

        
        // var_dump("headers",$headers, $indexUrl);
        if($headers === false || $httpCode == 404 || $opts["rewrite"]) {
            file_put_contents($this->indexFile,  $output);
        }
        curl_close($handle);
        return $this->dom;
    }

    function getUrl() 
    {
        return $this->indexFile;
    }

    function makeScript($el) 
    {
        $script = $this->dom->createElement('script');  
        $script->appendChild($this->dom->createTextNode(''));
        $script->setAttribute('src', $this->scriptsPath . $el["name"] . ".js");
        $script->setAttribute('type',  $el["type"]);

        //$script = 
        $this->body->appendChild($script);

        return $script;
    }

    function append2Dom() 
    {

    }

    function render()
    {

        // $script = $body->appendChild($script);
        

        // $html = $this->dom->load($indexFile);
        
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: ua\r\n"
            )
        );
            
        $context = stream_context_create($opts);

        $page = file_get_contents($this->indexUrl, false, $context);

        ob_get_flush();
        ob_clean();
        file_put_contents('php://output',  "<!DOCTYPE html>" . $page);
    }
}

?>