<?php
	define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "santransit");
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if($mysqli->connect_error){
		die("Connect failed (".$mysqli->errno.") ".$mysqli->error);
	}
?>