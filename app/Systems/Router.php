<?php
namespace App\Systems;

use Exception;
use App\Systems\Request;
use App\Systems\Resolver;

class Router{

	/**
	 * This is for routing GET requests
	 * 
	 * @param  string $url             
	 * @param  string $controllerDatas 
	 * @return Object                  
	 */
	public static function get(string $url,  $controllerDatas){
	
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

			//Check if it's a closure
			if (is_object($controllerDatas)) {

				$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
			    //Check if the closure has arguments or not
				if( empty($checkMethodArgs->getParameters()) ) return $controllerDatas();
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
				return $checkMethodArgs->invoke(...$instanceArray);
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$reflector = new \ReflectionClass($filePath);

			//Class construct args
			$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

			if(empty($class_constructor_args) ){

				$obj = new $filePath();

			}else{

				$args = self::getArgsParams($class_constructor_args);
				
				$obj = new $filePath(...$args);
			} 
			
			$class_methods = get_class_methods($obj);

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	
			    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);

					//Check if the method has arguments or not
		    		if(empty($checkMethodArgs->getParameters())) return $obj->$method_name();

					$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

					return $checkMethodArgs->invokeArgs($obj, $instanceArray);
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
			
			/* Dynamic Routing */

			//Check if it's a closure
			if (is_object($controllerDatas)) {

				$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
			    //Check if the closure has arguments or not
				if( empty($checkMethodArgs->getParameters()) ) return $controllerDatas();
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
				return $checkMethodArgs->invoke(...$instanceArray);
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$reflector = new \ReflectionClass($filePath);

			//Class construct args
			$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

			if(empty($class_constructor_args) ){

				$obj = new $filePath();

			}else{

				$args = self::getArgsParams($class_constructor_args);
				
				$obj = new $filePath(...$args);
			} 
			
			$class_methods = get_class_methods($obj);

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	
			    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);

					//Check if the method has arguments or not
		    		if(empty($checkMethodArgs->getParameters())) return $obj->$method_name();

					$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

					return $checkMethodArgs->invokeArgs($obj, $instanceArray);
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

		$server = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

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
			
			/* Dynamic Routing */

			//Check if it's a closure
			if (is_object($controllerDatas)) {

				$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
			    //Check if the closure has arguments or not
				if( empty($checkMethodArgs->getParameters()) ) return $controllerDatas();
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
				return $checkMethodArgs->invoke(...$instanceArray);
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$reflector = new \ReflectionClass($filePath);

			//Class construct args
			$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

			if(empty($class_constructor_args) ){

				$obj = new $filePath();

			}else{

				$args = self::getArgsParams($class_constructor_args);
				
				$obj = new $filePath(...$args);
			} 
			
			$class_methods = get_class_methods($obj);

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	
			    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);

					//Check if the method has arguments or not
		    		if(empty($checkMethodArgs->getParameters())) return $obj->$method_name();

					$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

					return $checkMethodArgs->invokeArgs($obj, $instanceArray);
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

		$server = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

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
			
			/* Dynamic Routing */

			//Check if it's a closure
			if (is_object($controllerDatas)) {

				$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
			    //Check if the closure has arguments or not
				if( empty($checkMethodArgs->getParameters()) ) return $controllerDatas();
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
				return $checkMethodArgs->invoke(...$instanceArray);
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$reflector = new \ReflectionClass($filePath);

			//Class construct args
			$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

			if(empty($class_constructor_args) ){

				$obj = new $filePath();

			}else{

				$args = self::getArgsParams($class_constructor_args);
				
				$obj = new $filePath(...$args);
			} 
			
			$class_methods = get_class_methods($obj);

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	
			    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);

					//Check if the method has arguments or not
		    		if(empty($checkMethodArgs->getParameters())) return $obj->$method_name();

					$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

					return $checkMethodArgs->invokeArgs($obj, $instanceArray);
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

		$server = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

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
			
			/* Dynamic Routing */

			//Check if it's a closure
			if (is_object($controllerDatas)) {

				$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
			    //Check if the closure has arguments or not
				if( empty($checkMethodArgs->getParameters()) ) return $controllerDatas();
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
				return $checkMethodArgs->invoke(...$instanceArray);
			}

			$controllerData = (explode("@",$controllerDatas));
			$controllerName = '\\'.$controllerData[0];
			
			$filePath = "\App\Controllers".$controllerName;

			$reflector = new \ReflectionClass($filePath);

			//Class construct args
			$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

			if(empty($class_constructor_args) ){

				$obj = new $filePath();

			}else{

				$args = self::getArgsParams($class_constructor_args);
				
				$obj = new $filePath(...$args);
			} 
			
			$class_methods = get_class_methods($obj);

			foreach ($class_methods as $method_name) {
			    if ($method_name === $controllerData[1]) {
			    	
			    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);

					//Check if the method has arguments or not
		    		if(empty($checkMethodArgs->getParameters())) return $obj->$method_name();

					$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

					return $checkMethodArgs->invokeArgs($obj, $instanceArray);
			    }
			}

			throw new Exception("This Controller Method $controllerData[1] is non-existent", 404);	
		}
	}


	/**
	 * This static method compares the exploded arrays of the url to the server's request URI
	 * NOTE:- This only works till the 2 offset of the arrays
	 * 
	 * @param  string $url 
	 * @return Boolean      
	 */
	public static function compareArray(string $url)
	{
		$server = (explode("/",$_SERVER['REQUEST_URI']));
		$url = (explode("/",$url));

		$compareOne = $url[1] <=> $server[1];

		//Check if the offset 2 doesn't exists for both arrays else return boolean values
		if (  (!isset($url[2]) && !isset($server[2]) ) && $compareOne == 0  ){
			return true;
		}

		if (  (!isset($url[2]) && !isset($server[2]) ) && $url[1] !== $server[1] ){
			return false;
		}
		
		//Check if the offset 2 exists in both arrays
		if (isset($url[2]) && isset($server[2]) ) {
			
			$compareTwo = $url[2] <=> $server[2];

			//Check if it's from a dynamic url
			if ( (strpos($url[2], "{") !== false) || (strpos($url[2], "}") !== false)  ) {
	    		$compareTwo = 0;
			}

			if (isset($url[2]) && isset($server[2]) && $compareOne == 0 && $compareTwo == 0 ) {
				return true;
			}else{
				return false;
			}
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
		//Save the dynamic url value in a request array
		if ( (strpos($urlArrayVal, "{") !== false) && (strpos($urlArrayVal, "}") !== false) ) {
			$_REQUEST[trim($urlArrayVal, '{,}')] = $serverPathArrayVal;
		}

		//For closures
		if (is_object($controllerDatas)) {

			$checkMethodArgs = new \ReflectionFunction($controllerDatas);
		    	
		    //Check if the closure has arguments or not
		    if(empty($checkMethodArgs->getParameters())) return $controllerDatas();

		    $instanceArray = self::getArgsParams($checkMethodArgs->getParameters());
				
			return $checkMethodArgs->invoke(...$instanceArray);
		}

		$controllerData = (explode("@",$controllerDatas));
		$controllerName = '\\'.$controllerData[0];
		
		$filePath = "\App\Controllers".$controllerName;

		$reflector = new \ReflectionClass($filePath);

		//Class construct args
		$class_constructor_args = !is_null($reflector->getConstructor()) ? (new \ReflectionMethod($filePath, '__construct'))->getParameters() : '';

		if(empty($class_constructor_args) ){

			$obj = new $filePath();

		}else{

			$args = self::getArgsParams($class_constructor_args);
				
			$obj = new $filePath(...$args);
		} 
		
		$class_methods = get_class_methods($obj);

		foreach ($class_methods as $method_name) {
		    if ($method_name === $controllerData[1]) {

		    	$checkMethodArgs = new \ReflectionMethod($filePath, $controllerData[1]);
		    	
		    	//Check if the method has arguments or not
		    	if(empty($checkMethodArgs->getParameters())) return $obj->$method_name(); 
				
				$instanceArray = self::getArgsParams($checkMethodArgs->getParameters());

				return $checkMethodArgs->invokeArgs($obj, $instanceArray);
		    }
		}
	}

	/**
	 * This method is for resolving dependencies in a recursive manner
	 * 
	 * @param   $params 
	 * @return array
	 */
	private static function getArgsParams($params)
	{
		foreach ($params as $arg) {
			if ( isset($arg->getClass()->name) ) {
				$initialize = $arg->getClass()->name;

				//Check if it's an interface
				if ( !(new \ReflectionClass($initialize))->isInstantiable()  ) {
					$initialize = get_interface_bindings($initialize);

					$initialize = !$initialize ? debug('Error with the interface binding. Kindly check !') : $initialize;	
				}
				
				if ((new \ReflectionClass($initialize))->isInstantiable() ) {

					$instanceArray[] = ( new Resolver() )->resolve($initialize);
				}
				
			}else{

				$instanceArray[] = $arg->getDefaultValue();
			}
		}

		return $instanceArray;
	}
}