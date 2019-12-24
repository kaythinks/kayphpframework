<?php

namespace App\Systems\Crons;

interface CronInterface{

	public function run();

	public function logic(string $className);
}