<?php

	if (!isset($_GET["distrib"]) || !isset($_GET["fichier"])) {
		echo "#!ipxe\n";
		exit("echo erreure: argument manquant\n");
	}

	if ($_GET["fichier"]!="kernel" && $_GET["fichier"]!="initrd") {
		echo "#!ipxe\n";
		exit("echo erreure: mauvaise requete\n");
	}

	error_reporting(0);

	require_once "distrib.php";

	$distrib = new Distrib($_GET["distrib"]);

	$filename = "";
	if($_GET["fichier"]=="kernel"){
		$filename = $distrib->getKernelPath();
	}
	else {
		$filename = $distrib->getInitrdPath();
	}

	$tmp = explode("/", $filename);
	header('Content-Disposition: attachment; filename="'. end($tmp) . '"');
	header("Content-Type: " + finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filename));

	$file = fopen($filename, "r");
	while (!feof($file)) {
		echo fread($file,8);
	}
	fclose($file);

?>