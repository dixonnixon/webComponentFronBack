<?php
namespace sys;

// CONST A = $_ENV['DBHOST'];

interface IConnectInfo
{
    // const HOST =  A;

	// const HOST = "db";
	// const UNAME = "admin";
	// const PW = "root";
	// const PORT = "3306";
	
	// const DBNAME = "Products";
	
	public static function doConnect($test);
}
?>