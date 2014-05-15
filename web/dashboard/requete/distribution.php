<?php

	header("Content-Type: text/plain");

	require_once "../../distrib.php";

	foreach (Distrib::getAll("../../..") as $tmp) {
		$distributions[] = $tmp->getName();
	}

	echo json_encode($distributions);

?>