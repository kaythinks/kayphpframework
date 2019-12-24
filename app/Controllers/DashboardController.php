<?php

namespace App\Controllers;

use App\Systems\Request;
use App\Controllers\Controller;
use App\Models\Countries;
use App\Models\User;
use App\Systems\Session;
use App\Systems\CloudinaryClient;
use App\Systems\Hash;

class DashboardController extends Controller{

	public function __construct()
	{
		parent::__construct();
		$this->middleware('auth');
	}

	public function home(){
		
		$id = Session::get('data')['id']; 

		$data = User::find($id);

		echo $this->twig->render('dashboard.php', ['data' => $data , 'one' => $id] );
	}

	public function getSingleProfile(Request $request)
	{
		$id = $request->get('id'); 

		$data = User::find($id);

		echo $this->twig->render('update.php', ['data' => $data ] );
	}

	public function logout()
	{
		session_destroy();
		return $this->redirect('/login');
	}

	public function updateProfile(Request $request)
	{

		if (!$request->isNull('picture')) {
			//If you want to save the file in the local server
			//$picPath = File::upload($request->get('picture'));

			//If you want to save the file on Cloudinary
			$picPath = (new CloudinaryClient())->uploadFile($request->get('picture')['tmp_name']);

			//Get file path name
			$request->put('picture',$picPath);
		}else{
			//unset($_REQUEST['picture']);
			$request->put('picture',User::find($request->get('id'))['picture']);
		}

		if (!$request->isNull('password')) {
			$request->put('password',Hash::make($request->get('password')));
		}
		else {
			//unset($_REQUEST['password']);
			$request->put('password',User::find($request->get('id'))['password']);
		}
		
		User::update($request);

		$this->redirect('/dashboard');
	}

	public function deleteProfile()
	{
		$id = Session::get('data')['id'];

		$data = User::find($id);

		$all = Request::push($data);

		User::delete((new Request() ));

		$this->logout();

	}
	
}