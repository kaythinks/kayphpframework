<?php

namespace App\Models;

use App\Models\Model;

class User extends Model{

	public $table = "users";

	public $table_attributes = [
		//Follow this format :- attribute_name => attribute_type
		"email" => "string:unique",
		"password" => "string",
		"username" => "string",
		"picture" => "string"
	];

}