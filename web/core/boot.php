<?php

	echo "#!ipxe\n";

	$settings = json_decode(file_get_contents("/etc/ipexpress/settings.json"));

?>

set shttp <?php echo $settings->{"web-server"}; ?>

set snfs  <?php echo $settings->{"nfs-server"}; ?>


chain http://${shttp}/ipexpress/core/menu.php?mac=${net0/mac}&ip=${net0/ip}&mask=${net0/netmask}&os=undefined
