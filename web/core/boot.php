<?php

	header("Content-Type: text/plain");

	echo "#!ipxe\nlogin\n";

	$settings = json_decode(file_get_contents("/etc/ipexpress/settings.json"));

?>

set shttp <?php echo $settings->{"web-server"} . "\n"; ?>
set snfs  <?php echo $settings->{"nfs-server"} . "\n"; ?>

chain http://${username:uristring}:${password:uristring}@${shttp}/ipexpress/core/menu.php?mac=${net0/mac}&ip=${net0/ip}&mask=${net0/netmask}&os=undefined
