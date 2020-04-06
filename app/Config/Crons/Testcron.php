<?php
namespace App\Config\Crons;

use App\Systems\Database;
use App\Systems\Mail;

class Testcron{

	protected $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function run()
	{
		//Write your logic here
		$recipientEmail = "kaythinks@gmail.com";
		$recipientFullName = "Kay Odole";
		$subject = "This is a KayPHP Demo Email";
		$body = file_get_contents('app/views/email/demo.php');

		Mail::sendEmail($recipientEmail, $recipientFullName, $subject, $body);

		//Close the Database connection
		$this->db->closeConnection();	
	}
}

//* * * * * php /Library/WebServer/Documents/kayphpframework/app/Systems/Crons/Cron.php > /dev/null 2>&1