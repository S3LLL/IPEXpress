<?php

	require_once "../settings.php";
	require_once "../db.php";

	header("Content-Type: text/plain");

	$connec = getPDO();

	$requete1 = "SELECT o.id_ordi, o.mac_ordi, INET_NTOA(o.ip_ordi) As ip_ordi, INET_NTOA(o.mask_ordi) As mask_ordi, o.boot_ordi, o.last_update_ordi, o.os_ordi
				 FROM ordinateur o
				 ORDER BY o.last_update_ordi DESC;";

	$tab = $connec->query($requete1);
	$rep = array();
	while($line = $tab->fetch()){
		$ordi["id"]     = $line["id_ordi"];
		$ordi["mac"]    = implode(":",str_split($line["mac_ordi"],2));
		$ordi["ip"]     = $line["ip_ordi"];
		$ordi["mask"]   = $line["mask_ordi"];
		$ordi["boot"]   = $line["boot_ordi"];
		$ordi["update"] = $line["last_update_ordi"];
		$ordi["os"]     = $line["os_ordi"];
		$rep[] = $ordi;
	}

	echo json_encode($rep);

?>