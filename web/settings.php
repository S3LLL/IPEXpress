<?php

	$system = json_decode(file_get_contents("/etc/ipexpress/settings.json"));

	$SET["db"]["user"]      = $system->{"db"}->{"user"};
	$SET["db"]["pass"]      = $system->{"db"}->{"pass"};
	$SET["db"]["server"]    = $system->{"db"}->{"server"};
	$SET["db"]["port"]      = $system->{"db"}->{"port"};
	$SET["db"]["name"]      = $system->{"db"}->{"name"};
	$SET["boot"]["default"] = $system->{"default-boot"};

?>