<?php

namespace App\Models;

use App\Systems\Database;
use App\Systems\Request;
use App\Models\ModelInterface;

class Model extends Database implements ModelInterface{

	/**
	 * This method is for getting the Database Type
	 * 
	 * @param  array  $data 
	 * @param  string $key  
	 * @return Response
	 */
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

	/**
	 * This method is for saving a request object
	 * 
	 * @param  mixed $request 
	 * @return Response
	 */
	public static function create($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->createOutput($model,$request);
	}

	/**
	 * This method is for saving and authenticating the request object
	 * 
	 * @param  mixed $request 
	 * @return Response
	 */
	public static function createAuth($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->createAuthenticated($model,$request);
	}

	/**
	 * This method is for getting all values from the Database
	 * 
	 * @return Response
	 */
	public static function all()
	{
		$model = get_called_class();
		
		return ( new Database() )->getAll($model);
	}

	/**
	 * This method is for getting a single response from the Database
	 * 
	 * @param  integer $id 
	 * @return Response
	 */
	public static function find($id)
	{
		$model = get_called_class();
		
		return ( new Database() )->getOne($model,$id);
	}

	/**
	 * This method is running a DB Query with the WHERE clause
	 * 
	 * @param  mixed $query 
	 * @param  mixed $data  
	 * @return Response
	 */
	public static function where($query,$data)
	{
		$query = "$query = '$data'";
		
		$model = get_called_class();
		
		return ( new Database() )->whereData($model,$query);
	}

	/**
	 * This method is running a DB Query with the WHERE clause
	 * 
	 * @param  mixed $query 
	 * @param  mixed $data  
	 * @return Response
	 */
	public static function checkWhere($query,$data)
	{
		$query = "$query = '$data'";
		
		$model = get_called_class();
		
		return ( new Database() )->checkWhereData($model,$query);
	}

	/**
	 * This method is for updating the Database Values
	 * 
	 * @param  Request $request 
	 * @return Response
	 */
	public static function update($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->updateData($model,$request,$request->get('id'));
	}

	/**
	 * This method is for deleting a resource from the Database
	 * 
	 * @param  mixed $request 
	 * @return Response
	 */
	public static function delete($request)
	{
		$model = get_called_class();
		
		return ( new Database() )->deleteData($model,$request,$request->get('id'));
	}

	/**
	 * This method is for writing raw queries to the Database
	 * 
	 * @param  string $query 
	 * @return Response
	 */
	public static function rawQueryGetOne(string $query)
	{
		return ( new Database() )->rawQueryOne($query);
	}

	/**
	 * This method is for writing raw queries to the Database
	 * 
	 * @param  string $query 
	 * @return Response
	 */
	public static function rawQueryGetAll(string $query)
	{
		return ( new Database() )->rawQueryAll($query);
	}
}