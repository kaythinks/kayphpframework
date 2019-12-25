<?php

namespace App\Models;

use App\Models\Model;

class Demo extends Model{

	public $table = "demos";

	public $table_attributes = [
		//Follow this format :- attribute_name => attribute_type
		"first_name" => "string",
		"last_name" => "string",
		"email" => "string:unique",
		"price" => "float"
	];

}