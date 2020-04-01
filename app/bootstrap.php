<?php

try {

	session_start();

	require __DIR__ .'/../vendor/autoload.php';

	//Set Error Type
	error_reporting(E_ERROR | E_PARSE);

	//Set the exception Handler method
	set_exception_handler('exception_handler');

	//Set Fatal Error Unhandled Handler Method
	register_shutdown_function('fatal_handler');

	//Checking the session time
	session_time_counter();

	//Set your application settings
	app_settings();

	$_SESSION['urls'] = [];

	require 'Route.php';

	// Handling non-existent routes
	if (isset($_SESSION['urls']) && !in_array($_SERVER['REQUEST_URI'],$_SESSION['urls']) && $_SERVER['REQUEST_URI'] !== '/') {	
		$_SESSION['urls'] = [];
		error_log(" # ".date('l jS \of F Y h:i:s A')." :- This route ".$_SERVER['REQUEST_URI']." doesn't exist in your Application !\r\n", 3, 'error.log');
		readfile('app/views/errors/404.php');
	}

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		//Set previous URL;
		$_SESSION['prev'] = $_SERVER['REQUEST_URI'];
	}
	
} catch (\Throwable $e) {

	error_log(" # ".date('l jS \of F Y h:i:s A')." :-This Error ' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3, 'error.log');
	error_log(" # ".date('l jS \of F Y h:i:s A')." :- This Error' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3, 'app/Systems/logs/error.log');

	setcookie('error', $e->getMessage() ." on Line ". $e->getLine()." of ". $e->getFile(), time() + (1), "/"); // 86400 = 1 day

	readfile('app/views/errors/500.php');
}