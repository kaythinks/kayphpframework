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
Router::get('/docs','HomeController@docs');

//Forgot Password
Router::get('/forgotpassword','HomeController@forgotPassword');

//Profile Page
Router::get('/dashboard', 'DashboardController@home');
Router::get('/updateprofile/{id}','DashboardController@getSingleProfile');
Router::get('/deleteprofile/{id}','DashboardController@deleteProfile');
Router::get('/logout', 'DashboardController@logout');



//////////////////////////////////////////////////////
///////////  P O S T   R O U T E S  /////////////////
////////////////////////////////////////////////////

Router::post('/login','LoginController@login');
Router::post('/register','RegisterController@register');
Router::post('/savedata','RegisterController@saveData');

//Forgot Password
Router::post('/forgotpassword','HomeController@postForgotPassword');

//Profile Page
Router::post('/updateprofile','DashboardController@updateProfile');
