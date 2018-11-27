<?php

namespace Kuro\Utility;

class StringExtension{

	public static function removeAll($str, $remove) {
		return str_replace($remove, "", $str);
	}

	public static function getBoolean($value, $default = true) {
		if (is_numeric($value)) {
			if ($value == 1) return true;
			if ($value == 0) return false;
		}
		if (is_string($value)) {
			$str_l = mb_strtolower($value);
			if ($str_l == "true") return true;
			if ($str_l == "false") return false;
		}
		return $default;
	}
}

?>