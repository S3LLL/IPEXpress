<?php

	header("Content-Type: text/plain");

	echo "#!ipxe\n";
	
	if(!isset($_GET["mac"]) || !isset($_GET["ip"])){
		exit("echo ip ou adresse mac manquant\n");
	}

	file_put_contents("boot.log",date('Y-m-d H:i:s') . " " . $_GET["mac"] . " " . $_GET["ip"] . " " . $_GET["mask"] . "\n",FILE_APPEND);	

	$_GET["mac"] = str_replace(":","",$_GET["mac"]);

	require_once "../distrib.php";
	require_once "db.php";

	if (!isindbOrdi($_GET["mac"])) {
		insertOrdi($_GET["mac"],$_GET["ip"],$_GET["mask"]);
	}	
	else {
		updateOrdi($_GET["mac"],$_GET["ip"],$_GET["mask"]);
	}

	$boot = getBoot($_GET["mac"]);

	switch ($boot) {
		case "asking":
		case "admin":
			updateOS($_GET["mac"],"undefined");
			updateBoot($_GET["mac"],"asking");
			echo "\nchain wait.php?mac=" . $_GET["mac"] . "\n";
			exit(0);
			break;
		case (Distrib::isValid($boot)):
			echo "\nchain launch.php?distrib=" . $boot . "&mac=" . $_GET["mac"] . "\n";
			exit(0);
			break;
	}

	$distributions = Distrib::getAll();

?>

:menu

menu ExpressOs boot menu

  item --gap Systeme d'exploitation
<?php foreach ($distributions as $item) { echo $item->menuItemIPXE(); } ?>

  item --gap 
  item --gap Actions
  item config   Configuration manuelle
  item ishell   iPXE shell
  item reboot   Redemarer
  item exit     Quitter iPXE et continnuer le demarage du BIOS
  choose choix


goto ${choix}

<?php foreach ($distributions as $item) { echo $item->menuSelectedIPXE($_GET["mac"]) . "\n"; } ?>

:config
	config
	goto menu

:ishell
	shell
	goto menu

:reboot
	reboot
	goto menu

:exit
