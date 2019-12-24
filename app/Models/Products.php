<?php

namespace App\Models;

use App\Models\Model;

class Products extends Model{

	public $table = "products";

	public $table_attributes = [
		//Follow this format :- attribute_name => attribute_type
		"description" => "string",
		"product_name" => "string",
		"email" => "string",
		"price" => "float"
	];

}