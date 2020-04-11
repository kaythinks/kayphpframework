<?php

require __DIR__ .'/../../vendor/autoload.php';

use App\Systems\Database;

class Migration{

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
	public function register()
	{
		//$this->db->createTable('Enter Model Name Here');	
		$this->db->createTable('User');	
		$this->db->createTable('Demo');	
		$this->db->createTable('Products');
		$this->db->createTable('Countries');

		//Close the Database connection
		$this->db->closeConnection();		
	}

}

(new Migration())->register();
