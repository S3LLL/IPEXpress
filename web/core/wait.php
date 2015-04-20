<?php

	header("Content-Type: text/plain");

	echo "#!ipxe\n";

	require_once "db.php";

	$os = getOS($_GET["mac"]);
	if ($os=="undefined") {
?>

echo attente du l'administrateur...
sleep 5
chain wait.php?mac=<?php echo $_GET["mac"] ?>

<?php

	} else {
		echo "\nchain launch.php?distrib=" . $os . "&mac=" . $_GET["mac"] . "\n";
	}
?>