<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Systems\Session;
use App\Systems\Middleware;
use Exception;

class Controller{

	protected $twig;

	public function __construct()
	{
		// Specify our Twig templates location
		$loader = new FilesystemLoader('app/views');

 		// Instantiate our Twig
		$twig = new Environment($loader);

		$this->twig = $twig;

		//Add the csrf token
		$this->twig->addGlobal('csrf_token', csrf_token());

		//Set authentication
		$auth = (Session::exists('auth')) ? true : false ;
		$this->twig->addGlobal('auth', $auth);

		//Check if the request is an API request
		$isApi = is_api();

		if ( ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_REQUEST['csrf_token']) && !$isApi || isset($_REQUEST['csrf_token']) && !$isApi && $_SESSION['csrf'] !== $_REQUEST['csrf_token']) ) throw new Exception("Token mismatch", 500);

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
	
	public function redirect(string $url)
	{
		//Redirect to the $url
		echo "<script type='text/JavaScript'> window.location.href ='".$url."'</script>";
	}
}