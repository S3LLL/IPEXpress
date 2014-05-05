<?php

	echo "#!ipxe\n";

	file_put_contents("boot.log",date('Y-m-d H:i:s') . " " . $_GET["mac"] . " " . $_GET["ip"] . " " . $_GET["mask"] . "\n",FILE_APPEND);	

	include "register.php";

?>

:menu

menu ExpressOs boot menu

  item --gap Systeme d'exploitation
  item debian_live   Debian
  item debian_fr     Debian (France)
  item windows       Windows

  item --gap 
  item --gap Actions
  item config   Configuration manuelle
  item ishell   iPXE shell
  item reboot   Redemarer
  item exit     Quitter iPXE et continnuer le demarage du BIOS
  choose choix


goto ${choix}

:debian_live
	chain http://${shttp}/~Jean/ipxe/register.php?mac=${net0/mac}&ip=${net0/ip}&mask=${net0/netmask}&os=debian
	chain debian/debian.ipxe
	goto menu

:debian_fr
	goto menu

:windows
	chain http://${shttp}/~Jean/ipxe/register.php?mac=${net0/mac}&ip=${net0/ip}&mask=${net0/netmask}&os=windows
	chain windows/windows.ipxe
	goto menu

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