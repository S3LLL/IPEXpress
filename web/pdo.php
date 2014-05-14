<?php

	require_once "settings.php";

	$pdoobj = NULL;

	function getPDO() {
		global $pdoobj;
		global $SET;
		if(!empty($pdoobj)){
			return $pdoobj;
		}
		try {
			$option = array (PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$connec = new PDO("mysql:host=" . $SET["db"]["server"] . ";port=" . $SET["db"]["port"] . ";dbname=" . $SET["db"]["name"], $SET["db"]["user"], $SET["db"]["pass"], $option);
		} catch(Exception $e) {
			die("#!ipxe\necho " . $e->getMessage());
		}
		$pdoobj = $connec;
		return $connec;
	}

?>