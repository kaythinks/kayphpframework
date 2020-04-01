<?php
/* 
	Write helper functions kayPHP
*/
if (!function_exists('debug')) {
	function debug($data)
	{
		echo '<pre>',print_r($data,1),'</pre>';
		die();
	}
}

if (!function_exists('csrf_token')) {
	function csrf_token()
	{
		if (isset($_SESSION['csrf'])){
			return $_SESSION['csrf'];
		} 
			
		$token = md5(uniqid(rand(), true));
		$_SESSION['csrf'] = $token;
		
		return $token;
	}
}

if (!function_exists('testit')) {
	function testit($str)
	{
		echo "yeah $str";
	}
}

if (!function_exists('session_time_counter')) {
	function session_time_counter()
	{
		$time = $_SERVER['REQUEST_TIME'];
		
		$timeout_duration = \App\Config\Env::SESSION_EXPIRY_TIME;

		if (isset($_SESSION['LAST_ACTIVITY']) && 
		   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		    session_unset();
		    session_destroy();
		    session_start();
		}

		$_SESSION['LAST_ACTIVITY'] = $time;
	}
}

if (!function_exists('app_settings')) {
	function app_settings()
	{
		
		$timezone = \App\Config\Env::TIME_ZONE;

		date_default_timezone_set($timezone);
	}
}

if (!function_exists('enable_cors')) {
	function enable_cors()
	{
		header('Access-Control-Allow-Origin: *');

		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

		header("Access-Control-Allow-Headers: *");

		header("Content-type:application/json");
	}
}

if (!function_exists('is_api')) {
	function is_api()
	{
		$server = (explode("/",$_SERVER['REQUEST_URI']));
		
		if (isset($server[1]) && $server[1] == 'api' ) {
			return true;
		}else{
			return false;
		}
	}
}

if (!function_exists('get_interface_bindings')) {
	function get_interface_bindings(string $name)
	{
		$binding = \App\Config\IocContainer\Container::$bindings;
	
		return isset($binding[$name]) ? $binding[$name] : false ;
	}
}

if (!function_exists('exception_handler')) {
	function exception_handler($e) {
  		error_log(" # ".date('l jS \of F Y h:i:s A')." :-This Error ' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3, 'error.log');
		error_log(" # ".date('l jS \of F Y h:i:s A')." :- This Error' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3, 'app/Systems/logs/error.log');

		setcookie('error', $e->getMessage() ." on Line ". $e->getLine()." of ". $e->getFile(), time() + (1), "/"); 

		readfile('app/views/errors/500.php');
	}
}

if (!function_exists('fatal_handler')) {
	function fatal_handler() {
		//Report only fatal or Parse Error or User Error
		error_reporting(E_ERROR | E_PARSE | E_USER_ERROR);

    	$error = error_get_last();
  
	    if( $error !== NULL && $error['type'] == 256) {
	      $errNo   = $error["type"];
	      $errFile = $error["file"];
	      $errLine = $error["line"];
	      $errMessage  = $error["message"];
	     
	    error_log(" # ".date('l jS \of F Y h:i:s A')." :-This Error ' ".$errMessage." ' with status type " . $errNo . " occured on line ". $errLine ." of file". $errFile."!\r\n", 3, 'error.log');

	    error_log(" # ".date('l jS \of F Y h:i:s A')." :-This Error ' ".$errMessage." ' with status type " . $errNo . " occured on line ". $errLine ." of file". $errFile."!\r\n", 3, 'app/Systems/logs/error.log');

		setcookie('error', $errMessage ." on Line ". $errLine." of ". $errFile, time() + (1), "/"); 

		readfile('app/views/errors/500.php');

	   	}
	}
}

