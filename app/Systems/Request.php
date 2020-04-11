<?php

namespace App\Systems;

use Exception;

class Request {

	public function __construct()
	{
		unset($_REQUEST['PHPSESSID']);
		foreach ($_FILES as $key => $value) {
			$_REQUEST[$key] = $value;
		}
	}

	public static function all()
	{
		return $_REQUEST;
	}

	public function get(string $name)
	{
		if (!$_REQUEST[$name]) throw new Exception("Attribute '".$name." 'does not exist in this Request object !", 404);
		
		return $_REQUEST[$name];
	}

	public static function exists(string $name)
	{
		if (!isset($_REQUEST[$name]) ) return false;
		
		return true;
	}

	public static function isNull(string $name)
	{
		if (isset($_REQUEST[$name]) && empty($_REQUEST[$name]) || isset($_REQUEST[$name]['name']) && empty($_REQUEST[$name]['name'])) return true;
		
		return false;
	}

	public static function put(string $name, $input)
	{
		$_REQUEST[$name] = $input;

		return true;
	}

	public static function push(array $input)
	{
		unset($_REQUEST);
		foreach ($input as $key => $value) {
			$_REQUEST[$key] = $value;
		}

		return true;
	}
}