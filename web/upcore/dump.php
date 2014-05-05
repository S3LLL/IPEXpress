<?php

	require_once "settings.php";
	require_once "db.php";

	$connec = getPDO();

	$requete1 = "SELECT o.id_ordi, o.mac_ordi, INET_NTOA(o.ip_ordi) As ip_ordi, INET_NTOA(o.mask_ordi) As mask_ordi, o.last_update_ordi, o.os_ordi
				FROM ordinateur o
				ORDER BY o.last_update_ordi DESC;";

	$tab = $connec->query($requete1);
	$rep = array();
	while($line = $tab->fetch()){
		$rep[$line["id_ordi"]]["id"]     = $line["id_ordi"];
		$rep[$line["id_ordi"]]["mac"]    = implode(":",str_split($line["mac_ordi"],2));
		$rep[$line["id_ordi"]]["ip"]     = $line["ip_ordi"];
		$rep[$line["id_ordi"]]["mask"]   = $line["mask_ordi"];
		$rep[$line["id_ordi"]]["update"] = $line["last_update_ordi"];
		$rep[$line["id_ordi"]]["os"]     = $line["os_ordi"];
	}

	echo json_encode($rep);

?>