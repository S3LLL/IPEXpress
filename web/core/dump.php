<?php

	if (!isset($_GET["distrib"]) || !isset($_GET["fichier"])) {
		echo "#!ipxe\n";
		exit("echo erreure: argument manquant\n");
	}

	require_once "../distrib.php";

	if (!Distrib::isValid($_GET["distrib"])) {
		exit("echo erreure: distribution inconnue\n");
	}

	if ($_GET["fichier"]!="kernel" && $_GET["fichier"]!="initrd") {
		echo "#!ipxe\n";
		exit("echo erreure: mauvaise requete\n");
	}

	error_reporting(0);

	$os = new Distrib($_GET["distrib"]);

	$file = "";
	if($_GET["fichier"]=="kernel"){
		$file = $os->getKernelPath();
	}
	else {
		$file = $os->getInitrdPath();
	}

	$tmp = explode("/", $file);
	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename="'. end($tmp) . '"');
	header('Expires: 0');
	header("Content-Type: " + finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file));
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);
	exit;