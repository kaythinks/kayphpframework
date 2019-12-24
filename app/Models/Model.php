<?php

namespace App\Models;

use App\Config\Database;
use App\Systems\Request;

class Model extends Database{

	public function getDBType(array $data, string $key)
	{
		if ($data[$key] == "string") {

			return "VARCHAR(191) NOT NULL";
		}

		if ($data[$key] == "integer") {

			return "INT(11) NOT NULL";
		}

		if($data[$key] == "float"){

			return "DOUBLE(10,2) NOT NULL";
		}

		if($data[$key] == "timestamp") {
			
			return "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
		}

		if ($data[$key] == "string:unique") {

			return "VARCHAR(191) NOT NULL UNIQUE";
		}

		if ($data[$key] == "integer:unique") {

			return "INT(11) NOT NULL UNIQUE";
		}

		if($data[$key] == "float:unique"){

			return "DOUBLE(10,2) NOT NULL UNIQUE";
		}
	}

	public static function create($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->createOutput($model,$request);
	}

	public static function createAuth($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->createAuthenticated($model,$request);
	}


	public static function all()
	{
		$model = get_called_class();
		
		return ( new Database() )->getAll($model);
	}

	public static function find($id)
	{
		$model = get_called_class();
		
		return ( new Database() )->getOne($model,$id);
	}

	public static function where($query,$data)
	{
		$query = "$query = '$data'";
		
		$model = get_called_class();
		
		return ( new Database() )->whereData($model,$query);
	}

	public static function checkWhere($query,$data)
	{
		$query = "$query = '$data'";
		
		$model = get_called_class();
		
		return ( new Database() )->checkWhereData($model,$query);
	}

	public static function update($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->updateData($model,$request,$request->get('id'));
	}

	public static function delete($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->deleteData($model,$request,$request->get('id'));
	}

	public static function rawQueryGetOne(string $query)
	{
		return ( new Database() )->rawQueryOne($query);
	}

	public static function rawQueryGetAll(string $query)
	{
		return ( new Database() )->rawQueryAll($query);
	}
}