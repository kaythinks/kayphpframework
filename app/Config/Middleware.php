<?php

namespace App\Config;

use Exception;

/**
 * This utility class contains different methods which serve as middlewares for different use cases. Add your own middleware methods
 */
class Middleware{

	public static function auth()
	{
		//Redirect to the previous URL
		if (!$_SESSION['auth']) return header('Location: /login');
	}

	public static function __callStatic(string $name, array $arguments)
	{
		throw new Exception("This middleware method {$name} is non-existent", 500);
	}
}