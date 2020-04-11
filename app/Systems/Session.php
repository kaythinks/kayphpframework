<?php

namespace App\Systems;

use Exception;

class Session{

	public static function all()
	{
		return $_SESSION;
	}

	public static function get(string $name)
	{
		if (!$_SESSION[$name]) throw new Exception("Attribute '".$name." 'does not exist in this Session object !", 1);
		
		return $_SESSION[$name];
	}

	public static function put(string $name, $input)
	{
		$_SESSION[$name] = $input;
	}

	public static function exists(string $name)
	{
		if (isset($_SESSION[$name])) return true;
		
		return false;
	}

	public static function destroy(string $name)
	{
		if (isset($_SESSION[$name])) {
			unset($_SESSION[$name]);
		}else{
			throw new Exception("Attribute '".$name." 'does not exist in this Session object !", 1);
		}
	}
}