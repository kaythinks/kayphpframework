<?php

namespace App\Controllers;

use App\Systems\Request;
use App\Controllers\Controller;
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

	/**
	 * This method is for accessing the dashboard view
	 * 
	 * @return Response
	 */
	public function home(){
		
		$id = Session::get('data')['id']; 

		$data = User::find($id);

		echo $this->twig->render('dashboard.php', ['data' => $data ] );
	}

	/**
	 * This method is for accessing a user profile
	 * 
	 * @param  Request $request 
	 * @return Response
	 */
	public function getSingleProfile(Request $request)
	{
		$id = $request->get('id'); 

		$data = User::find($id);

		echo $this->twig->render('update.php', ['data' => $data ] );
	}

	/**
	 * This method is for logging out
	 * 
	 * @return Response
	 */
	public function logout()
	{
		session_destroy();
		return $this->redirect('/login');
	}

	/**
	 * This method is for updating a user profile
	 * 
	 * @param  Request $request 
	 * @return Response
	 */
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
			
			$request->put('picture',User::find($request->get('id'))['picture']);
		}

		if (!$request->isNull('password')) {
			$request->put('password',Hash::make($request->get('password')));
		}
		else {
			
			$request->put('password',User::find($request->get('id'))['password']);
		}
		
		User::update($request);

		$this->redirect('/dashboard');
	}

	/**
	 * This method is for deleting a user profile
	 * 
	 * @return Response
	 */
	public function deleteProfile()
	{
		User::delete($request);

		$this->logout();

	}
	
}