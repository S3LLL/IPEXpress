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

	function isindbOrdi($mac){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$requete = "SELECT count(*)
						FROM `ordinateur`
						WHERE `mac_ordi`=:mac;";
			$q = $connec->prepare($requete);
			$q->bindParam('mac', $mac, PDO::PARAM_STR);
			$q->execute();
			$q = $q->fetch();
			return $q[0];
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la verification de l'ordinateur dans la base de donnee : ".$e->getMessage() . "\nprompt\n");
		}
		return -1;
	}

	function updateOrdi($mac,$ip,$mask,$os="undefined"){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("UPDATE `ordinateur` 
										SET `ip_ordi`=INET_ATON(:ip),`mask_ordi`=INET_ATON(:mask),`last_update_ordi`=NULL,`os_ordi`=:os
										WHERE `mac_ordi`=:mac;");
			$insert->bindParam('mac', $mac, PDO::PARAM_STR);
			$insert->bindParam('ip', $ip, PDO::PARAM_STR);
			$insert->bindParam('mask', $mask, PDO::PARAM_STR);
			$insert->bindParam('os', $os, PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la mise a jour de l'ordinateur dans la base de donnee : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

	function insertOrdi($mac,$ip,$mask,$os="undefined"){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("INSERT INTO `ordinateur`(`id_ordi`, `mac_ordi`, `ip_ordi`, `mask_ordi`, `last_update_ordi`, `os_ordi`) 
										VALUES (NULL,:mac,INET_ATON(:ip),INET_ATON(:mask),NULL,:os);");
			$insert->bindParam('mac', $mac, PDO::PARAM_STR);
			$insert->bindParam('ip', $ip, PDO::PARAM_STR);
			$insert->bindParam('mask', $mask, PDO::PARAM_STR);
			$insert->bindParam('os', $os, PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreure est survenue lors de l'insertion de l'ordinateur dans la base de donne : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

?>