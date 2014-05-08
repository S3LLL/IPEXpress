<?php

	echo "#!ipxe\n";

	if (!isset($_GET["distrib"])) {
		exit("echo erreure: distribution manquante\n");
	}

	require_once "distrib.php";

	$distrib = new Distrib($_GET["distrib"]);

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
	echo arguments: root=/dev/nfs rw nfsroot=${snfs}:/home/jean/ipexpress/nfs/mounted/<?php echo $distrib->getFolder() . " " . $distrib->getBootArguments(); ?>
	
	prompt
	boot || goto fail
