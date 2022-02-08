<?php
namespace sys;

class UniversalConnect implements IConnectInfo
{
	private static $server;      
	private static $currentDB;   
	private static $user;        
	private static $pass;        
	private static $port;        
	private static $hookup;
	
	public static function doConnect($test) {
        // var_dump($_ENV);
        self::$server= $_ENV['DBHOST'];
        self::$currentDB = $_ENV['DBNAME'];
        self::$user = $_ENV['UNAME'];
        self::$pass = $_ENV['PW'];
        self::$port = $_ENV['PORT'];
        
		try {
			// $options = array(
				// \PDO::ATTR_PERSISTENT => true,
				// \PDO::ATTR_ERRMODE    => \PDO::ERRMODE_EXCEPTION
			// );
			
			if(!self::$hookup) {
				self::$hookup = new \PDO(
					"mysql:host=" . self::$server . ";port=" . self::$port . ";dbname=" . self::$currentDB,
					self::$user, 
					self::$pass
				);
				// echo "hookup";
				// print_r(self::$hookup);
				self::$hookup->setAttribute(\PDO::ATTR_ERRMODE,  \PDO::ERRMODE_EXCEPTION);
				// PDO("sqlsrv:Server=$server;Database=$db_name", $username, $password);
				if(self::$hookup) {
					($test == "test") ? print "Connection successfull: " : "";
				} else {
					echo('<br>The Reason is: ' . self::$hookup->errorCode() . "<br>");
					echo "<pre>";
					print_r(self::$hookup->errorInfo());
					echo "</pre>";
				}
			}
			return self::$hookup;
			
		} catch(PDOException $e) {
			$e->getMessage();
		}
		
	}
	
		
	
}

?>