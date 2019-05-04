<?php
	define('DBhost', 'localhost');
	define('DBuser', 'uyo_lga');
	define('DBPass', 'uyolgaadmin');
	define('DBname', 'uyo_lga');
	
	try {
		$conn = new PDO("mysql:host=".DBhost.";dbname=".DBname,DBuser,DBPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		die($e->getMessage());
	}
	
?>