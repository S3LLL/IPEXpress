<?php

	header("Content-Type: text/plain");

	echo "#!ipxe\n";

	if (!isset($_GET["distrib"])) {
		exit("echo erreure: distribution manquante\n");
	}

	if (!in_array($_GET["distrib"], scandir("../../distrib")) || in_array($_GET["distrib"], array(".","..","README.md","windows"))) {
		exit("echo erreure: distribution inconnue\n");
	}

	require_once "distrib.php";

	$distrib = new Distrib($_GET["distrib"]);

	$nfspath = json_decode(file_get_contents("/etc/ipexpress/settings.json"))->{"web-server"} . "nfs/mounted/";

?>

goto lauch

:fail
	echo appuyer sur une touche pour retourner au menu principale
	prompt
	exit

:lauch
	echo Lancement de <?php echo $distrib->getName() . "\n"; ?>
	kernel dump.php?distrib=<?php echo $distrib->getFolder(); ?>&fichier=kernel root=/dev/nfs rw nfsroot=${snfs}:/home/jean/ipexpress/nfs/mounted/<?php echo $distrib->getFolder() . " " . $distrib->getBootArguments(); ?> || goto fail
	initrd dump.php?distrib=<?php echo $distrib->getFolder(); ?>&fichier=initrd || goto fail
	echo arguments: root=/dev/nfs rw nfsroot=${snfs}:<?php echo $nfspath . $distrib->getFolder() . " " . $distrib->getBootArguments(); ?>
	boot || goto fail
