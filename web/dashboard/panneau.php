<?php

	require_once "../distrib.php";
	require_once "../pdo.php";

	try {
		$connec = getPDO();

		$requete1 = "SELECT o.id_ordi, o.mac_ordi, o.boot_ordi
					 FROM ordinateur o
					 ORDER BY o.id_ordi;";

		$tab = $connec->query($requete1);
		$rep = array();
		while($line = $tab->fetch()){
			$ordi["id"]     = $line["id_ordi"];
			$ordi["mac"]    = implode(":",str_split($line["mac_ordi"],2));
			$ordi["boot"]   = $line["boot_ordi"];
			$rep[] = $ordi;
		}
	}
	catch(Exception $e){
		echo("panneau.php: ".$e->getMessage());
	}

	foreach (Distrib::getAll() as $distrib) {
		$option[$distrib->getFolder()] = $distrib->getName();
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>IPEXpress Paramettres</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<link rel='stylesheet' type='text/css' href='dashboard.css' />
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css'>
		<script type='text/javascript' src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type='text/javascript' src='panneau.js' ></script>
	</head>
	<body>

		<a href="https://github.com/S3LLL/IPEXpress"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>

		<div id="param" >
			<table>
				<tr>
					<th>#</th>
					<th>mac</th>
					<th>boot</th>
				</tr>
				<?php

					foreach ($rep as $line) {
						echo "<tr id='t" . $line["id"] . "' >";
						echo "<td>" . $line["id"] . "</td>";
						echo "<td>" . $line["mac"] . "</td>";
						echo "<td>";
						if ($line["boot"]=="user") {
							echo "<span id='c" . $line["id"] . "' class='action'>Choix de l'utilisateur</span>";
						}
						elseif ($line["boot"]=="admin") {
							echo "<span id='c" . $line["id"] . "' class='action'>Choix de l'admin</span>";
						}
						elseif (isset($option[$line["boot"]])) {
							echo "<span id='c" . $line["id"] . "' class='action'>" . $option[$line["boot"]] . "</span>";
						}
						else {
							echo "<span id='c" . $line["id"] . "' class='action'>undefined</span>";
						}
						echo "<select id='s" . $line["id"] . "' onchange='set(" . $line["id"] . ")' class='choix'>";
						if ($line["boot"]=="user") {
							echo "<option selected='selected' value='user' >Choix de l'utilisateur</option>";
						}
						else {
							echo "<option value='user' >Choix de l'utilisateur</option>";
						}
						if ($line["boot"]=="admin") {
							echo "<option selected='selected' value='admin' >Choix de l'admin</option>";
						}
						else {
							echo "<option value='admin' >Choix de l'admin</option>";
						}
						foreach ($option as $raw => $real) {
							if ($line["boot"]==$raw) {
								echo "<option selected='selected' value='" . $raw . "' >" . $real . "</option>";
							}
							else {
								echo "<option value='" . $raw . "' >" . $real . "</option>";
							}
						}
						echo "</select></td>";
						echo "<td><img src='delete.png' onclick='del(" . $line["id"] . ")'/></td></tr>\n";
					}

				?>
			</table>
		</div>

		<div id="nav">
			
			<h1>IPEXpress</h1>

			Panneau<br /><br />

			<a href="index.html">Retour</a>
		</div>

	</body>
</html>
