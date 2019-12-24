<?php
/* 
	Write helper functions kayPHP
*/
if (!function_exists(debug)) {
	function debug($data)
	{
		echo '<pre>',print_r($data,1),'</pre>';
		die();
	}
}

if (!function_exists(csrf_token)) {
	function csrf_token()
	{
		if (isset($_SESSION['csrf'])){
			return $_SESSION['csrf'];
		} 
			
		$token = md5(uniqid(rand(), true));
		$_SESSION['csrf'] = $token;
		//$_REQUEST['csrf_token'] = $token;
		return $token;
	}
}

if (!function_exists(test)) {
	function testit()
	{
		echo "yeah";
	}
}

if (!function_exists(session_time_counter)) {
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

if (!function_exists(app_settings)) {
	function app_settings()
	{
		
		$timezone = \App\Config\Env::TIME_ZONE;

		date_default_timezone_set($timezone);
	}
}

if (!function_exists(enable_cors)) {
	function enable_cors()
	{
		header('Access-Control-Allow-Origin: *');

		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

		header("Access-Control-Allow-Headers: *");

		header("Content-type:application/json");
	}
}

if (!function_exists(is_api)) {
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

