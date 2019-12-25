<?php

namespace App\Controllers;

use App\Systems\Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Systems\Validator;
use App\Systems\Hash;
use App\Systems\Session;

class LoginController extends Controller{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * This method is for logging users in
	 * 
	 * @param  Request $request 
	 * @return Response
	 */
	public function login(Request $request){

		//Validating input request
		$check = Validator::check($request->all(),[
			"email" => ["required","email"]
		]);

		if (!$check) return $this->redirect('/login');

		$data = User::where('email',$request->get('email'));
		
		if (!empty($data) && Hash::check($data['password']) == $request->get('password')){
			//Create an authentication session
			Session::put('auth','auth');

		}else{
			Session::put('error','Invalid Login or Password !');
			return $this->redirect('/login');
		}
		//Pass data to the session
		Session::put('data',$data);

		return $this->redirect('/dashboard');
	}
	
}