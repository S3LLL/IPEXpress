<?php

	//echo $_POST["id"];

	if (!isset($_POST["id"]) || !isset($_POST["nom"])) {
		exit("order.php: paramettre manquant");
	}

	require_once "../../distrib.php";

	if (!Distrib::isValid($_POST["nom"],"../../..") && $_POST["nom"]!="user" && $_POST["nom"]!="admin") {
		exit("order.php: mauvaise ordre de boot");
	}

	require_once "../../pdo.php";

	try{
		$connec = getPDO();
		$insert = $connec->prepare("UPDATE `ordinateur` 
									SET `boot_ordi`=:boot
									WHERE `id_ordi`=:id;");
		$insert->bindParam('id',   $_POST["id"],  PDO::PARAM_INT);
		$insert->bindParam('boot', $_POST["nom"], PDO::PARAM_STR);
		return $insert->execute();
	}
	catch( Exception $e ){
		echo("order.php: ".$e->getMessage() . "\nprompt\n");
	}

?>