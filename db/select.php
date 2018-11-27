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
$has_show = (4 <= count($argv))? Sx::getBoolean($argv[3]) : true;

echo($city_id . "のテーブル[" . $table_name . "]を検索します。" . PHP_EOL . PHP_EOL);

$db = new DbConfig();
$db->parse($city_id);

exec($db->getConnect() . 
     " -e 'select * from " . $table_name . ";'"
     , $list, $result);

if ($result != 0) echo("エラー(select): " . $result . PHP_EOL);

$filename = __DIR__ . "/../" . $city_id . "_" . $table_name . ".dmp";
file_put_contents($filename, $list, LOCK_EX);

if ($has_show) var_dump($list);

echo("クエリ実行結果を出力しました。" . PHP_EOL);
echo("filename: " . $filename . PHP_EOL);

?>