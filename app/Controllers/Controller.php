<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Systems\Session;
use App\Config\Middleware;
use Exception;

class Controller{

	protected $twig;

	public function __construct()
	{
		$loader = new FilesystemLoader('app/views');

		$twig = new Environment($loader);

		$this->twig = $twig;

		$this->twig->addGlobal('csrf_token', csrf_token());

		$this->twig->addGlobal('auth', Session::exists('auth'));

		//Check if the request is an API request
		$isApi = is_api();

		if ( ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_REQUEST['csrf_token']) && !$isApi || isset($_REQUEST['csrf_token']) && !$isApi && $_SESSION['csrf'] !== $_REQUEST['csrf_token']) ){
			if (Env::ENVIRONMENT === "production") {
				echo "<script type='text/JavaScript'>
				let answer = window.confirm('Session expired ! Click OK to refresh');

	        	if(answer) window.history.back();
				  </script>";

				die();  
			}else{
				throw new Exception("Token Mismatch!", 500);
				
			}
		}

		//Prevent login or register access if authenticated
		if ( ($_SERVER['REQUEST_URI'] == '/login' || $_SERVER['REQUEST_URI'] == '/register' || $_SERVER['REQUEST_URI'] == '/forgotpassword') && isset($_SESSION['auth']) ) echo "<script type='text/JavaScript'> window.location.href ='/dashboard'; </script>";
		
	}

	/**
	 * This method serves as a guard for authorization;
	 * 
	 * @param  string $name 
	 * @return Response
	 */
	public function middleware(string $method)
	{
		//Call the middleware method
		Middleware::$method();
	}

	/**
	 * This is used to get the session value if it exists
	 * 
	 * @param  string $sessionName 
	 * @return string
	 */
	public function getSession(string $sessionName)
	{
		if (Session::exists($sessionName)) {

			$sessionValue = Session::get($sessionName);
			
			Session::destroy($sessionName);

			return $sessionValue;
		}else{
			$sessionValue = false;

			return $sessionValue;
		}
	}
	
	/**
	 * This method is for redirecting URL's
	 * 
	 * @param  string $url 
	 * @return response
	 */
	public function redirect(string $url)
	{
		//Redirect to the $url
		echo "<script type='text/JavaScript'> window.location.href ='".$url."'</script>";
	}
}