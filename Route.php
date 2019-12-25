<?php

use App\Systems\Router;
use App\Systems\Request;

//////////////////////////////////////////////////////
///////////   G E T   R O U T E S   /////////////////
////////////////////////////////////////////////////

Router::get('/','HomeController@index');
Router::get('/login','HomeController@login');
Router::get('/register','HomeController@register');
Router::get('/api/checkpoint','HomeController@getResponse');
Router::get('/test-point','HomeController@setRequestHeader');
Router::get('/check','HomeController@getData');
Router::get('/getdata','RegisterController@getData');
Router::get('/getdatasingle','RegisterController@getsingleData');

//Forgot Password
Router::get('/forgotpassword','HomeController@forgotPassword');
Router::post('/forgotpassword','HomeController@postForgotPassword');

//Profile Page
Router::get('/dashboard', 'dashboardController@home');
Router::post('/updateprofile','dashboardController@updateProfile');
Router::get('/updateprofile/{id}','dashboardController@getSingleProfile');
Router::get('/deleteprofile','dashboardController@deleteProfile');

Router::get('/logout', 'dashboardController@logout');
Router::get('/docs', 'HomeController@docs');

// Calling a closure via the router and passing a query string
Router::get('/test',function(Request $request){
	//trigger_error("Fatal error", E_USER_ERROR);
	//throw new Exception("Error Processing Request", 1);
	
	debug(new PDOException);
});

Router::get('/dbquery',function(){
	$query = "select * from users where id = 1 ";
	$response = (new \App\Config\Database())->rawQueryOne($query);
	debug($response);
});

Router::get('/dbquery-all',function(){
	$query = "select * from users";
	$response = (new \App\Config\Database())->rawQueryAll($query);
	debug($response);
});


// Calling a closure via the router
Router::get('/test-alone',function(){
	kayphp();
	echo "it works !";
});

//Sending Emails
Router::get('/send-email', 'HomeController@sendMail');

//Redis server testing
Router::get('/redis',function(){
	debug((new \App\Systems\Redis())->setex('victory','this rocks!',10));
});

//Cloudinary Server Testing
Router::get('/cloudinary',function(){
	debug( (new \App\Systems\CloudinaryClient())->uploadFile('http://mycodeprojects.com.ng/public/kayphplogo.png') );
});

//Sending a Mail to the Queue
Router::get('/queue-mail','HomeController@queueEmails');

// Calling a dynamic URL with closure via the router 
Router::get('/tested_ok/{slug}',function(Request $request){

	echo $request->get('slug'); 
});

// Calling a dynamic URL with closure via the router without a function parameter
Router::get('/tested/{slug}',function(){

	echo "Genius level unlocked !"; 
});

// Calling a dynamic route requires you type-hint the Request object in your method as an argument
Router::get('/docs/{id}', 'HomeController@docsRequest');

//////////////////////////////////////////////////////
///////////  P O S T   R O U T E S  /////////////////
////////////////////////////////////////////////////

Router::post('/login','LoginController@login');
Router::post('/api/login','LoginController@login');
Router::post('/check','HomeController@getRequest');
Router::post('/register','RegisterController@register');
Router::post('/savedata','RegisterController@saveData');
Router::post('/updatedata','RegisterController@updateData');
Router::post('/deletedata','RegisterController@deleteData');