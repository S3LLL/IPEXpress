<?php

	echo "#!ipxe\n";

	require_once "distrib.php";

	//file_put_contents("boot.log",date('Y-m-d H:i:s') . " " . $_GET["mac"] . " " . $_GET["ip"] . " " . $_GET["mask"] . "\n",FILE_APPEND);	

	// include "register.php";

	$available     = scandir("../../distrib");
	$exclude       = array(".","..","README.md","windows");
	$distributions = array();

	$taille_original = count($available);
	for ($i=0; $i<$taille_original; $i++) { 
		if (!in_array($available[$i],$exclude)) {
			$distributions[] = new Distrib($available[$i]);
		}
	}

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

<?php foreach ($distributions as $item) { echo $item->menuSelectedIPXE() . "\n"; } ?>

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