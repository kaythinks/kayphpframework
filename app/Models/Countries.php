<?php

namespace App\Models;

use App\Models\Model;

class Countries extends Model{

	public $table = "countries";

	public $table_attributes = [
		//Follow this format :- attribute_name => attribute_type
		"country_name" => "string",
		"country_code" => "string"
	];
}