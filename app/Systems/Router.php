<?php
namespace App\Systems;

use Exception;
use App\Systems\Request;

class Router{

	/**
	 * This is for routing GET requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function get(string $url,  $controllerDatas){

		//$serverPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

		$server = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		$serverPath = strpos($server, "?") ? substr($server, 0, strpos($server, "?")) : $server; 
		
		if ($url == $serverPath && $_SERVER['REQUEST_METHOD'] == "GET" || self::compareArray($url) && $_SERVER['REQUEST_METHOD'] == "GET")
		{
			$_SESSION['urls'][] = $serverPath;

			/* Dynamic Routing */

			$urlArray = (explode("/",$url));
			$serverPathArray = (explode("/",$serverPath));
			
			if (isset($urlArray[2]) && isset($serverPathArray[2])) {
				
				return self::checkDynamicRoute($urlArray[2], $serverPathArray[2], $controllerDatas);
			}
			
			/* Dynamic Routing */

			if (is_object($controllerDatas)) {
				
				if(!$_GET) return $controllerDatas();
				
				return $controllerDatas(new Request()); 
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$obj = new $filePath();
			
			$class_methods = get_class_methods(new $filePath());

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	if(!$_GET) return $obj->$method_name();
				
					return $obj->$method_name(new Request());
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}

	/**
	 * This is for routing POST requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function post(string $url,  $controllerDatas){

		//$serverPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		$server = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		$serverPath = strpos($server, "?") ? substr($server, 0, strpos($server, "?")) : $server; 
	
		if ($url == $serverPath && $_SERVER['REQUEST_METHOD'] == "POST" || self::compareArray($url) && $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$_SESSION['urls'][] = $serverPath;

			/* Dynamic Routing */

			$urlArray = (explode("/",$url));
			$serverPathArray = (explode("/",$serverPath));
			
			if (isset($urlArray[2]) && isset($serverPathArray[2])) {
				
				return self::checkDynamicRoute($urlArray[2], $serverPathArray[2], $controllerDatas);
			}
			
			if (is_object($controllerDatas)) {
				if(!$_POST) return $controllerDatas();
				
				return $controllerDatas(new Request()); 
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$obj = new $filePath();
			
			$class_methods = get_class_methods(new $filePath());

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	if(!$_POST) return $obj->$method_name();
				
					return $obj->$method_name(new Request());
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}

	/**
	 * This is for routing PUT requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function put(string $url,  $controllerDatas){

		//$serverPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		$serverPath = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		$serverPath = strpos($server, "?") ? substr($server, 0, strpos($server, "?")) : $server; 
	
		if ($url == $serverPath && $_SERVER['REQUEST_METHOD'] == "PUT" || self::compareArray($url) && $_SERVER['REQUEST_METHOD'] == "PUT" )
		{
			$_SESSION['urls'][] = $serverPath;

			/* Dynamic Routing */

			$urlArray = (explode("/",$url));
			$serverPathArray = (explode("/",$serverPath));
			
			
			if (isset($urlArray[2]) && isset($serverPathArray[2])) {

				return self::checkDynamicRoute($urlArray[2], $serverPathArray[2], $controllerDatas);
			}

			if (is_object($controllerDatas)) {
				if(!$_POST) return $controllerDatas();
				
				return $controllerDatas(new Request()); 
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$obj = new $filePath();
			
			$class_methods = get_class_methods(new $filePath());

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	if(!$_POST) return $obj->$method_name();
				
					return $obj->$method_name(new Request());
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}

	/**
	 * This is for routing PATCH requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function patch(string $url,  $controllerDatas){

		//$serverPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		$serverPath = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		$serverPath = strpos($server, "?") ? substr($server, 0, strpos($server, "?")) : $server; 
	
		if ($url == $serverPath && $_SERVER['REQUEST_METHOD'] == "PATCH" || self::compareArray($url) && $_SERVER['REQUEST_METHOD'] == "PATCH" )
		{
			$_SESSION['urls'][] = $serverPath;

			/* Dynamic Routing */

			$urlArray = (explode("/",$url));
			$serverPathArray = (explode("/",$serverPath));
			
			
			if (isset($urlArray[2]) && isset($serverPathArray[2])) {

				return self::checkDynamicRoute($urlArray[2], $serverPathArray[2], $controllerDatas);
			}

			if (is_object($controllerDatas)) {
				if(!$_POST) return $controllerDatas();
				
				return $controllerDatas(new Request()); 
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$obj = new $filePath();
			
			$class_methods = get_class_methods(new $filePath());

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	if(!$_POST) return $obj->$method_name();
				
					return $obj->$method_name(new Request());
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}

	/**
	 * This is for routing DELETE requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function delete(string $url,  $controllerDatas){

		//$serverPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		$serverPath = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		$serverPath = strpos($server, "?") ? substr($server, 0, strpos($server, "?")) : $server; 
	
		if ($url == $serverPath && $_SERVER['REQUEST_METHOD'] == "DELETE" || self::compareArray($url) && $_SERVER['REQUEST_METHOD'] == "DELETE" )
		{
			$_SESSION['urls'][] = $serverPath;

			/* Dynamic Routing */

			$urlArray = (explode("/",$url));
			$serverPathArray = (explode("/",$serverPath));
			
			
			if (isset($urlArray[2]) && isset($serverPathArray[2])) {

				return self::checkDynamicRoute($urlArray[2], $serverPathArray[2], $controllerDatas);
			}

			if (is_object($controllerDatas)) {
				if(!$_POST) return $controllerDatas();
				
				return $controllerDatas(new Request()); 
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$obj = new $filePath();
			
			$class_methods = get_class_methods(new $filePath());

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	if(!$_POST) return $obj->$method_name();
				
					return $obj->$method_name(new Request());
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}


	/**
	 * This static method compares the exploded arrays of the url to the server's request URI
	 * 
	 * @param  string $url 
	 * @return Boolean      
	 */
	public static function compareArray(string $url)
	{
		//$server = (explode("/",$_SERVER['PATH_INFO']));
		$server = (explode("/",$_SERVER['REQUEST_URI']));
		$url = (explode("/",$url));

		$compareOne = $url[1] <=> $server[1];

		$compareTwo = $url[2] <=> $server[2];

		if ( (strpos($url[2], "{") !== false) || (strpos($url[2], "}") !== false)  ) {
    		$compareTwo = 0;
		}

		if (isset($url[2]) && isset($server[2]) && $compareOne == 0 && $compareTwo == 0 ) {
			return true;
		}else{
			return false;
		}
	}

	/**
	 * This method checks if the route is dynamic
	 * 
	 * @param  string $url            
	 * @param  string $serverPath      
	 * @param  string|object  $controllerDatas 
	 * @return Response              
	 */
	public static function checkDynamicRoute(string $urlArrayVal, string $serverPathArrayVal, $controllerDatas)
	{
		$_REQUEST[trim($urlArrayVal, '{,}')] = $serverPathArrayVal;

		//For closures
		if (is_object($controllerDatas)) {

			$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
		    //Check if the closure has arguments or not
		    if(empty($checkMethodArgs->getParameters())) return $controllerDatas();
		
			return $controllerDatas(new Request()); 
		}

		$controllerData = (explode("@",$controllerDatas));
		$controllerName = '\\'.$controllerData[0];
		
		$filePath = "\App\Controllers".$controllerName;

		$obj = new $filePath();
		
		$class_methods = get_class_methods(new $filePath());

		foreach ($class_methods as $method_name) {
		    if ($method_name === $controllerData[1]) {

		    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);
		    	
		    	//Check if the method has arguments or not
		    	if(empty($checkMethodArgs->getParameters())) return $obj->$method_name(); 
			
				return $obj->$method_name(new Request()); 
		    }
		}
	}
}