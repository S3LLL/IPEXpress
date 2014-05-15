<?php



	header("Content-Type: text/plain");

	if (!isset($_POST["idordi"]) || !isset($_POST["osordi"])) {
		exit("choice.php: arguments manquqnts");
	}

	require_once "../../distrib.php";

	$distrib_obj = Distrib::getAll("../../..");
	foreach ($distrib_obj as $distrib) {
		$nom[] = $distrib->getName();
	}
	if (!in_array($_POST["osordi"],$nom)) {
		exit("choice.php: distribution non supporté");
	}

	require_once "../../pdo.php";

	$distrib = $distrib_obj[array_search($_POST["osordi"], $nom)]->getFolder();

	try{
		$connec = getPDO();

		$update = $connec->prepare("UPDATE `ordinateur` 
			SET `boot_ordi`='admin',`os_ordi`=:os 
			WHERE `id_ordi`=:id");

		$update->bindParam('os', $distrib, PDO::PARAM_STR);
		$update->bindParam('id', $_POST["idordi"],    PDO::PARAM_INT);
		return $update->execute();
	}
	catch(Exception $e){
		echo("choice.php: ".$e->getMessage());
	}

?>