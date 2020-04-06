<?php

require __DIR__ .'/../../../vendor/autoload.php';

use App\Config\Crons\Testcron;
use App\Config\Crons\CronInterface;

class Cron implements CronInterface{

	/**
	 * This method runs the cron
	 * 
	 * @return Void
	 */
	public function run()
	{
		$this->logic(Testcron::class);
		//Add as many cron jobs as you like
	}

	/**
	 * This is where you call the class containing the Cron Logic
	 * 
	 * @param  string $className 
	 * @return Void
	 */
	public function logic(string $className)
	{
		( new $className())->run();
	}
}

(new Cron())->run();

//* * * * * php /Library/WebServer/Documents/kayphpframework/app/Config/Crons/Cron.php > /dev/null 2>&1