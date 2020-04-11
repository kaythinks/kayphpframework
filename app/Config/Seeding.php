<?php

require __DIR__ .'/../../vendor/autoload.php';

use App\Systems\Database;
use App\Systems\Hash;
use App\Systems\Request;

class Seeding{

	protected $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	/**
	 * Add a new table and run the Migration script 
	 * 
	 * @return Response
	 */
	public function run()
	{
		//$this->seedData(string $model, $request)
		$this->seedData('User', (new Request())->push([
			"email" => "xyz77@xyz.comz",
			"password" => Hash::make('secret11'),
			"username" => "xyzy",
			"picture" => "",
		]));

		$this->seedData('User', (new Request())->push([
			"email" => "great77@great.comz",
			"password" => Hash::make('secret11'),
			"username" => "great",
			"picture" => "",
		]));

		$this->seedData('User', (new Request())->push([
			"email" => "great99@gmail.comz",
			"password" => Hash::make('secret11'),
			"username" => "great11",
			"picture" => "",
		]));

		$this->seedData('Demo', (new Request())->push([
			"first_name" => "kay",
			"last_name" => "Odole",
			"email" => "kaythinks@gmail.comz",
			"price" => "200.00"
		]));

		$this->seedData('Countries', (new Request())->push([
			"country_name" => "Nigeria",
			"country_code" => "NG"
		]));

		$this->seedData('Countries', (new Request())->push([
			"country_name" => "USA",
			"country_code" => "US"
		]));

		$this->seedData('Countries', (new Request())->push([
			"country_name" => "Brazil",
			"country_code" => "BR"
		]));

		$this->seedData('Countries', (new Request())->push([
			"country_name" => "Qatar",
			"country_code" => "QR"
		]));

		//Close the Database connection
		$this->db->closeConnection();	
	}

	public function seedData(string $model, $request)
	{
		$this->db->seedAuthenticated("App\Models\\$model", (new Request));
	}

}

(new Seeding())->run();
