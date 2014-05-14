<?php

	header("Content-Type: text/plain");

	require_once "../../distrib.php";

	$available     = scandir("../../../distrib");
	$exclude       = array(".","..","README.md","windows");
	$distributions = array();

	$taille_original = count($available);
	for ($i=0; $i<$taille_original; $i++) { 
		if (!in_array($available[$i],$exclude)) {
			$tmp = new Distrib($available[$i],"../../..");
			$distributions[] = $tmp->getName();
		}
	}

	echo json_encode($distributions);

?>