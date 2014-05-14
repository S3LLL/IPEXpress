<?php



	header("Content-Type: text/plain");

	if (!isset($_POST["idordi"]) || !isset($_POST["osordi"])) {
		exit("choice.php: arguments manquqnts");
	}

	require_once "../../distrib.php";

	$available     = scandir("../../../distrib");
	$exclude       = array(".","..","README.md","windows");
	$distributions = array();

	$taille_original = count($available);
	for ($i=0; $i<$taille_original; $i++) { 
		if (!in_array($available[$i],$exclude)) {
			$tmp = new Distrib($available[$i],"../../..");
			$distrib_obj[] = $tmp;
			$distributions[] = $tmp->getName();
		}
	}

	if (!in_array($_POST["osordi"],$distributions)) {
		exit("choice.php: distribution non supporté");
	}

	require_once "../../pdo.php";

	$distrib = $distrib_obj[array_search($_POST["osordi"], $distributions)]->getFolder();

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