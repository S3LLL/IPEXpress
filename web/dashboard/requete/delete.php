<?php

	//echo $_POST["id"];

	if (!isset($_POST["id"])) {
		exit("delete.php: paramettre manquant");
	}

	require_once "../../pdo.php";

	try{
		$connec = getPDO();
		$insert = $connec->prepare("DELETE FROM `ordinateur`
									WHERE `id_ordi`=:id;");
		$insert->bindParam('id',   $_POST["id"],  PDO::PARAM_INT);
		return $insert->execute();
	}
	catch( Exception $e ){
		echo("order.php: ".$e->getMessage() . "\nprompt\n");
	}

?>