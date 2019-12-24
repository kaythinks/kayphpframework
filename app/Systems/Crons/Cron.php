<?php

require __DIR__ .'/../../../vendor/autoload.php';

use App\Systems\Crons\Testcron;
use App\Systems\Crons\CronInterface;

class Cron implements CronInterface{

	public function run()
	{
		$this->logic(Testcron::class);
		//Add as many cron jobs as you like
	}

	public function logic(string $className)
	{
		( new $className())->run();
	}
}

(new Cron())->run();

//* * * * * php /Library/WebServer/Documents/kayphpframework/app/Systems/Crons/Cron.php > /dev/null 2>&1