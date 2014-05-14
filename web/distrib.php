<?php

class Distrib {

	private $settings;
	private $folder;

	function __construct($folder,$deep="../.."){
		$this->folder   = $folder;
		$this->settings = json_decode(file_get_contents($deep . "/distrib/" . $folder . "/param.json"));
	}

	function menuItemIPXE(){
		return "  item " . $this->folder . " " . $this->settings->{"name"} . "\n";
	}

	function menuSelectedIPXE(){
		$output  = ":" . $this->folder . "\n";
		$output .= "  chain launch.php?distrib=" . $this->folder . "\n";
		$output .= "  goto menu\n";
		return $output;
	}

	function getFolder(){
		return $this->folder;
	}

	function getName(){
		return $this->settings->{"name"};
	}

	function getKernelPath(){
		return "../../distrib/" . $this->folder . "/" . $this->settings->{"kernel"};
	}

	function getInitrdPath(){
		return "../../distrib/" . $this->folder . "/" . $this->settings->{"initrd"};
	}

	function getBootArguments(){
		return $this->settings->{"args"};
	}

} 