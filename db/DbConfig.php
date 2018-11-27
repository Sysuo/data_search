<?php
namespace Kuro\Db;

require_once __DIR__ . "/../commandDefine.php";
require_once __DIR__ . "/../util/StringExtension.php";

use Kuro\Utility\StringExtension as Sx;

class DbConfig{

	private $name = "";
	private $user = "";
	private $pass = "";

	public function getName() {
		return $this->name;
	}

	public function getUser() {
		return $this->user;
	}

	public function getPass() {
		return $this->pass;
	}

	public function parse($city_id) {
		$db_configs = shell_exec(CMD_HEAD . $city_id . CMD_SHOW_DB);

		foreach(explode(PHP_EOL, $db_configs) as $line) {
			$arr = explode(" : ", $line);
			if (count($arr) < 2) continue;
			
			$label = trim(array_shift($arr));
			$value = Sx::removeAll(array_shift($arr), "\"");
			
			
			// echo("isset [" . $label . "] " . isset($this->{$label}). PHP_EOL);
			if (isset($this->{$label})) {
				$this->{$label} = $value;
				// echo($label . " = " . $this->{$label} . ":" . $value . PHP_EOL);
			}
		}
	}

	public function getConnect() {
		if (is_null($this->getName())) throw Exception("nameがありません。");
		if (is_null($this->getUser())) throw Exception("userがありません。");
		if (is_null($this->getPass())) throw Exception("passがありません。");

		return "mysql -u " . $this->getName() . 
		" --password=" . $this->getPass() . " " . 
		$this->getUser();
	}
}

?>