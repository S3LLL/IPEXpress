<?php

	header("Content-Type: text/plain");

	echo "#!ipxe\n";

	if (!isset($_GET["distrib"])) {
		exit("echo erreure: distribution manquante\n");
	}

	require_once "../distrib.php";

	if (!Distrib::isValid($_GET["distrib"])) {
		exit("echo erreure: distribution inconnue\n");
	}

	if (isset($_GET["mac"])) {
		require_once "db.php";
		updateOS($_GET["mac"],$_GET["distrib"]);
	}

	$distrib = new Distrib($_GET["distrib"]);

	$nfspath = json_decode(file_get_contents("/etc/ipexpress/settings.json"))->{"path"} . "nfs/mounted/";

?>

goto lauch

:fail
	echo appuyer sur une touche pour continuer
	prompt
	exit

:lauch
	echo Lancement de <?php echo $distrib->getName() . "\n"; ?>
	kernel dump.php?distrib=<?php echo $distrib->getFolder(); ?>&fichier=kernel root=/dev/nfs rw nfsroot=${snfs}:<?php echo $nfspath . $distrib->getFolder() . " " . $distrib->getBootArguments(); ?> || goto fail
	initrd dump.php?distrib=<?php echo $distrib->getFolder(); ?>&fichier=initrd || goto fail
	echo arguments: root=/dev/nfs rw nfsroot=${snfs}:<?php echo $nfspath . $distrib->getFolder() . " " . $distrib->getBootArguments() . "\n"; ?>
	boot || goto fail
