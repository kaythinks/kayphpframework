<?php

namespace App\Config\Crons;

interface CronInterface{

	public function run();

	public function logic(string $className);
}