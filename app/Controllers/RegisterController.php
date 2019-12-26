<?php

namespace App\Controllers;

use App\Systems\Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Systems\Hash;
use App\Systems\Validator;
use App\Systems\Session;
use App\Systems\File;
use App\Systems\Logger;
use App\Systems\CloudinaryClient;
use Exception;


class RegisterController extends Controller{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Creating an Authenticated User
	 * 
	 * @param  Request $request 
	 * @throws\Exception
	 * @return Response         
	 */
	public function saveData(Request $request){
		
		//Validating input request e.g "email" => ["required","email","unique:Model Name"],
		$check = Validator::check($request->all(),[
			"email" => ["required","email","unique:User"],
			"password" => ["required"],
			"username" => ["required"],
			"picture" => ["required","file"]
		]);

		if (!$check) return $this->redirect('/register');

		try{
			//If you want to save the file in the local server
			//$picPath = File::upload($request->get('picture'));

			//If you want to save the file on Cloudinary
			$picPath = (new CloudinaryClient())->uploadFile($request->get('picture')['tmp_name']);

			//Update the Hashing method
			$request->put('password',Hash::make($request->get('password')));

			//Get file path name
			$request->put('picture',$picPath);

			User::createAuth($request);

			$data = User::where('email',$request->get('email'));

			if(!empty($data))
			{
				//Create an authentication session
				Session::put('auth', 'auth');
			}else{
				Session::put('error','Unable to register !');
				return $this->redirect('/register');
			}

			//Pass data to the session
			Session::put('data', $data);
			
			//Redirect to the Dashboard
			return $this->redirect('/dashboard');
			
		}catch(Exception $e){

			Session::put('error',$e->getMessage());
			Logger::error($e);
			return $this->redirect('/register');
		}
	}
}