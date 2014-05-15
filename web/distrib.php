<?php

class Distrib {

	private $settings;
	private $folder;
	private $deep;

	private static $exclude = array(".","..","README.md","windows");

	function __construct($folder,$deep="../.."){
		$this->folder   = $folder;
		$this->deep     = $deep;
		$this->settings = json_decode(file_get_contents($deep . "/distrib/" . $folder . "/param.json"));
	}

	public function menuItemIPXE(){
		return "  item " . $this->folder . " " . $this->settings->{"name"} . "\n";
	}

	public function menuSelectedIPXE($mac){
		$output  = ":" . $this->folder . "\n";
		$output .= "  chain launch.php?distrib=" . $this->folder . "&mac=" . $mac . "\n";
		$output .= "  goto menu\n";
		return $output;
	}

	public function getFolder(){
		return $this->folder;
	}

	public function getName(){
		return $this->settings->{"name"};
	}

	public function getKernelPath(){
		return $this->deep . "/distrib/" . $this->folder . "/" . $this->settings->{"kernel"};
	}

	public function getInitrdPath(){
		return $this->deep . "/distrib/" . $this->folder . "/" . $this->settings->{"initrd"};
	}

	public function getBootArguments(){
		return $this->settings->{"args"};
	}

	public static function getAll($deep="../.."){
		$available       = scandir($deep . "/distrib");
		$distributions   = array();
		$taille_original = count($available);
		for ($i=0; $i<$taille_original; $i++) { 
			if (!in_array($available[$i],self::$exclude)) {
				$distributions[] = new Distrib($available[$i],$deep);
			}
		}
		return $distributions;
	}

	public static function isValid($nom,$deep="../.."){
		$available = scandir($deep . "/distrib");
		return (in_array($nom, $available) && !in_array($nom, self::$exclude));
	}

} 