<?php

	require_once "../pdo.php";
	require_once "../settings.php";

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

	function getBoot($mac){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$requete = "SELECT `boot_ordi`
						FROM `ordinateur`
						WHERE `mac_ordi`=:mac;";
			$q = $connec->prepare($requete);
			$q->bindParam('mac', $mac, PDO::PARAM_STR);
			$q->execute();
			$q = $q->fetch();
			return $q[0];
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la recuperation de l'OS dans la base de donnee : " . $e->getMessage() . "\nprompt\n");
		}
		return -1;
	}

	function getOS($mac){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$requete = "SELECT `os_ordi`
						FROM `ordinateur`
						WHERE `mac_ordi`=:mac;";
			$q = $connec->prepare($requete);
			$q->bindParam('mac', $mac, PDO::PARAM_STR);
			$q->execute();
			$q = $q->fetch();
			return $q[0];
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la recuperation de l'OS dans la base de donnee : " . $e->getMessage() . "\nprompt\n");
		}
		return -1;
	}

	function updateOS($mac,$os){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("UPDATE `ordinateur` 
										SET `os_ordi`=:os, `last_update_ordi`=NULL
										WHERE `mac_ordi`=:mac;");
			$insert->bindParam('mac',  $mac,  PDO::PARAM_STR);
			$insert->bindParam('os',   $os,   PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la mise a jour de l'OS dans la base de donnee : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

	function updateBoot($mac,$boot){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("UPDATE `ordinateur` 
										SET `boot_ordi`=:boot
										WHERE `mac_ordi`=:mac;");
			$insert->bindParam('mac',  $mac,  PDO::PARAM_STR);
			$insert->bindParam('boot', $boot, PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la mise a jour de l'OS dans la base de donnee : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

	function updateOrdi($mac,$ip,$mask,$os="undefined"){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("UPDATE `ordinateur` 
										SET `ip_ordi`=INET_ATON(:ip),`mask_ordi`=INET_ATON(:mask),`last_update_ordi`=NULL,`os_ordi`=:os
										WHERE `mac_ordi`=:mac;");
			$insert->bindParam('mac',  $mac,  PDO::PARAM_STR);
			$insert->bindParam('ip',   $ip,   PDO::PARAM_STR);
			$insert->bindParam('mask', $mask, PDO::PARAM_STR);
			$insert->bindParam('os',   $os,   PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreur est survenue lors de la mise a jour de l'ordinateur dans la base de donnee : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

	function insertOrdi($mac,$ip,$mask,$os="undefined",$boot="user"){
		$mac = str_replace(":","",$mac);
		try{
			$connec = getPDO();
			$insert = $connec->prepare("INSERT INTO `ordinateur`(`id_ordi`, `mac_ordi`, `ip_ordi`, `mask_ordi`, `boot_ordi`, `last_update_ordi`, `os_ordi`) 
										VALUES (NULL,:mac,INET_ATON(:ip),INET_ATON(:mask),:boot,NULL,:os);");
			$insert->bindParam('mac',  $mac,                    PDO::PARAM_STR);
			$insert->bindParam('ip',   $ip,                     PDO::PARAM_STR);
			$insert->bindParam('mask', $mask,                   PDO::PARAM_STR);
			$insert->bindParam('boot', $SET["boot"]["default"], PDO::PARAM_STR);
			$insert->bindParam('os',   $os,                     PDO::PARAM_STR);
			$insert->bindParam('boot', $boot,                   PDO::PARAM_STR);
			return $insert->execute();
		}
		catch( Exception $e ){
			echo("echo Une erreure est survenue lors de l'insertion de l'ordinateur dans la base de donne : ".$e->getMessage() . "\nprompt\n");
		}
		return false;
	}

?>