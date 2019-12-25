<?php

namespace App\Systems;

use App\Systems\Request;
use App\Systems\Session;
use App\Models\User;

class Validator{

	public static function check(array $request,array $data){

		foreach ($data as $key => $value) {

			$model = self::checkAttributeValue($value);
										
			if (!isset($request[$key]) && in_array("required", $value)) {

				Session::put("error","$key is required !");
				return false;	
			}

			if (isset($request[$key]) && in_array("email", $value) && !filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {

				Session::put("error","$key value must be a valid email !");
				return false;	
			}

			if (isset($request[$key]) && in_array("integer", $value) && !filter_var($request[$key], FILTER_VALIDATE_INT)) {

				Session::put("error","$key value must be a valid integer !");
				return false;
			}

			if (isset($request[$key]) && in_array("float", $value) && !filter_var($request[$key], FILTER_VALIDATE_FLOAT)) {
				
				Session::put("error","$key value must be a valid float !");
				return false;
			}

			if (isset($request[$key]) && in_array("url", $value) && !filter_var($request[$key], FILTER_VALIDATE_URL)) {
				
				Session::put("error","$key value must be a valid url !");
				return false;
			}

			if (isset($request[$key]) && in_array("file", $value) && $request[$key]['type'] !=  ('image/png'||'image/pdf'||'image/jpg'||'image/jpeg') ) {
				
				Session::put("error","$key type must be a valid file type !");
				return false;
			}

			if (isset($request[$key]) && $model !== null ) {

				$modelName = '\\'.$model;
			
				$filePath = '\App\Models'.$modelName;
				if (!class_exists($filePath)) {

				   Session::put("error","$model model doesn't exist !");
				   return false;
				}

  				$data = $filePath::checkWhere($key,$request[$key]);
  				
  				if (isset($data[$key])) {

  					Session::put("error","$key value must be unique !");
  					return false;
  				}
			}
		}

		return true;
	}

	public static function checkAttributeValue($value)
	{
		foreach ($value as $keys) {
			if(preg_match("/:/", $keys)){
				
				$modelName = preg_split('/:/', $keys);
				
				return $modelName[1];
			}	
		}
	}
}