<?php
namespace sys;

interface IConnectInfo
{
    // const HOST = $_ENV['DB_HOST'];

	const HOST = "db";
	const UNAME = "admin";
	const PW = "root";
	const PORT = "3306";

	
	const DBNAME = "Products";
	
	public static function doConnect($test);
}
?>