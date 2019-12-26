<?php

namespace App\Models;

interface ModelInterface{

	public function getDBType(array $data, string $key);
}