<?php

require "DbConfig.php";
require_once __DIR__ . "/../util/StringExtension.php";

use Kuro\Db\DbConfig;
use Kuro\Utility\StringExtension as Sx;

if (count($argv) < 3) {
	exit;
}

$city_id = $argv[1];
$table_name = $argv[2];

echo($city_id . "のテーブル[" . $table_name . "]をカウントします。" . PHP_EOL);

$db = new DbConfig();
$db->parse($city_id);

exec($db->getConnect() . 
	 " -e 'select count(id) from " . $table_name . ";'"
	 , $count, $result);

if ($result != 0) echo("エラー(select): " . $result . PHP_EOL);

echo($city_id . "[" . $table_name . "]: " . $count[1] . PHP_EOL);

?>