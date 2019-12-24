<?php

namespace App\Systems;

class Logger{
	
	public static function message(string $input){
		error_log(" # ".date('l jS \of F Y h:i:s A')." :-  ".$input."!\r\n", 3, 'error.log');
		error_log(" # ".date('l jS \of F Y h:i:s A')." :-  ".$input."!\r\n", 3, __DIR__ .'/logs/error.log');
	}

	public static function error(\Exception $e){
		error_log(" # ".date('l jS \of F Y h:i:s A')." :- This Error ' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3, 'error.log');
		error_log(" # ".date('l jS \of F Y h:i:s A')." :- This Error ' ".$e->getMessage()." ' with status code " . $e->getCode() . " occured on line ". $e->getLine() ." of file". $e->getFile()." STACKTRACE ".$e->getTraceAsString()."!\r\n", 3,  __DIR__ .'/logs/error.log');
	}
}