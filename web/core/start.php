<?php

	require_once "settings.php";
	require_once "db.php";

	function start($mac,$ip,$mask,$os){
		if (!isindbOrdi($mac)) {
			insertOrdi($mac,$ip,$mask,$os);
		}	
		else {
			updateOrdi($mac,$ip,$mask,$os);
		}
	}

?>