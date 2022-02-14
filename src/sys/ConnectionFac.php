<?php
namespace sys;
class ConnectionFac extends ConnectionCreator
{
    private $conn;
    function __construct() 
    {
        $this->port = $_SERVER['SERVER_PORT'];
        $this->forwardedPort = $_SERVER['HTTP_X_FORWARDED_PORT'];

        // if($this->isSecure()) {
        //     $this->conn = new Secure();
        // }
        $this->syntax = [ "secure" , "rocky" ];
    }

    function handle()
    {
        $expr = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ( ! empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        || ( ! empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
        || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
        || (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] == 443)
        || (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https');

        //building sequence of expressions
        
        $this->run($this->buildExpr([
            $expr,
            !$expr
        ]));
    }

    protected function buildExpr($exprs)
    {
        return array_filter(array_map(function($el, $syn) {
            $conn = "sys\\" . ucfirst($syn);
            if($el) return new $conn();
        }, array_combine($this->syntax, $exprs), $this->syntax),
        function($v) { return $v;} );
    }   

    protected function run($connectionStatements)
    {
        
        foreach($connectionStatements as $conn) {
            $conn->execute();
        }
    }
    
}

?>