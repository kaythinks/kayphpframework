<?php

namespace App\Config;

/**
 * This utility class contains different methods which serve as middlewares for different use cases. Add your own middleware methods
 */
class Middleware{

	public static function auth()
	{
		//Redirect to the previous URL
		if (!$_SESSION['auth']) echo "<script type='text/JavaScript'> window.location.href ='/login'; </script>";
			
		
		//if($_SESSION['auth'] !== $name) echo "<script type='text/JavaScript'> window.location.href ='".$_SESSION['prev']."'</script>";
	}
}