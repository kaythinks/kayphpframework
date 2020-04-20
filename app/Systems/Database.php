<?php

namespace App\Systems;

use App\Config\Env as ENV;
use PDO;
use PDOException;
use App\Systems\Request;
use App\Systems\Logger;

class Database{

	public $dbh;

	public function __construct()
	{
		/* Connect to a specific database using driver invocation */
		try {
			$this->dbh = new PDO(ENV::DB_DRIVER.':dbname='.ENV::DB_NAME.';host='.ENV::DB_HOST,ENV::DB_USER,ENV::DB_PASSWORD); 

        	$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {

			Logger::error($e);

		    echo 'Connection failed: ' . $e->getMessage();
		}

	}

	public function createTable(string $model)
	{
		$modelName = '\\'.$model;
			
		$filePath = '\App\Models'.$modelName;

		$model = new $filePath();
	
		try{
		    
		    $data = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$data .= "`$key`".$model->getDBType($model->table_attributes,$key).",";
	 		}

	 		$sql = "CREATE TABLE IF NOT EXISTS `".$model->table."` ( `id` INT NOT NULL AUTO_INCREMENT, ".$data ."`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  PRIMARY KEY (`id`)) ";

	 		$this->dbh->exec($sql);

	 		echo "Table ". $model->table." created successfully !\r\n";
		}
		catch(PDOException $e)
		{
			Logger::error($e);
		    echo "There is some problem in connection:- " . $e->getMessage()." \r\n";
		}
	}

	public function createOutput(string $model, Request $request)
	{
		$model = new $model();
		try
		{
			$data = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$data .= "$key".",";
	 		}

	 		$values = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$values .= ":"."$key ".",";
	 		}

	 		$data = rtrim($data, ','); 

	 		$values = rtrim($values, ','); 

		    // inserting data into create table using prepare statement to prevent from sql injections
		    $stmt = $this->dbh->prepare("INSERT INTO ".$model->table." ($data) VALUES ( $values )");
		    
		    $explodedValues = explode(',', $values);
		    $explodedDatas = explode(',', $data);
		    
		    foreach ($request->all() as $key => $req) {
		    	if (!in_array($key, $explodedDatas) ) {
		    		unset($_REQUEST[$key]);
		    	}
		    }

		    // inserting a record
		    $stmt->execute($request->all());

		    echo "New record created successfully";

		    $this->closeConnection();
		}
		catch (PDOException $e)
		{
			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}

	}

	public function createAuthenticated(string $model, Request $request)
	{
		$model = new $model();
		try
		{
			$data = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$data .= "$key".",";
	 		}

	 		$values = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$values .= ":"."$key ".",";
	 		}

	 		$data = rtrim($data, ','); 

	 		$values = rtrim($values, ','); 

		    // inserting data into create table using prepare statement to prevent from sql injections
		    $stmt = $this->dbh->prepare("INSERT INTO ".$model->table." ($data) VALUES ( $values )");
		    
		    $explodedValues = explode(',', $values);
		    $explodedDatas = explode(',', $data);
		    
		    foreach ($request->all() as $key => $req) {
		    	if (!in_array($key, $explodedDatas) ) {
		    		unset($_REQUEST[$key]);
		    	}
		    }

		    // inserting a record
		    $stmt->execute($request->all());

		    return true;

		    $this->closeConnection();
		}
		catch (PDOException $e)
		{
			Logger::error($e);

		   throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}

	}

	public function seedAuthenticated(string $model, Request $request)
	{
		$model = new $model();
		try
		{
			$data = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$data .= "$key".",";
	 		}

	 		$values = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$values .= ":"."$key ".",";
	 		}

	 		$data = rtrim($data, ','); 

	 		$values = rtrim($values, ','); 

		    // inserting data into create table using prepare statement to prevent from sql injections
		    $stmt = $this->dbh->prepare("INSERT INTO ".$model->table." ($data) VALUES ( $values )");
		    
		    $explodedValues = explode(',', $values);
		    $explodedDatas = explode(',', $data);
		    
		    foreach ($request->all() as $key => $req) {
		    	if (!in_array($key, $explodedDatas) ) {
		    		unset($_REQUEST[$key]);
		    	}
		    }

		    // inserting a record
		    $stmt->execute($request->all());

		    echo " Data created successfully ! \r\n";
		}
		catch (PDOException $e)
		{
			Logger::error($e);

		    throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}

	}


	public function getAll(string $model)
	{
		$model = new $model();
		try{
			$sql = "SELECT * FROM ".$model->table;

        	$data = $this->dbh->query($sql);

        	$obj = $data->fetchAll(PDO::FETCH_ASSOC);
        	
        	$this->closeConnection();

        	return $obj;
        	
		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function whereData(string $model, string $query)
	{
		$model = new $model();
		try{

			$sql = "SELECT * FROM $model->table WHERE $query";
			
        	$data = $this->dbh->query($sql);
        	
        	$obj = $data->fetch(PDO::FETCH_ASSOC);

        	$this->closeConnection();

        	if(!$obj) return null;

        	return $obj;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function checkWhereData(string $model, string $query)
	{
		$model = new $model();
		try{

			$sql = "SELECT * FROM $model->table WHERE $query";
			
        	$data = $this->dbh->query($sql);
        	
        	$obj = $data->fetch();
        	
        	$this->closeConnection();

        	if(!$obj) return null;

        	return $obj;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function getOne(string $model,int $id)
	{
		$model = new $model();
		try{

			$sql = "SELECT * FROM $model->table WHERE ID = $id";

        	$data = $this->dbh->query($sql);

        	$obj = $data->fetch();
        	
        	$this->closeConnection();

        	if(!$obj) throw new PDOException("ID does not exist in the Database!", 404);

        	return $obj;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function updateData(string $model, Request $request ,int $id)
	{
		$model = new $model();
		try{
			//Check if data exists in the DB
			$check = "SELECT * FROM $model->table WHERE ID = $id";
        	$checking = $this->dbh->query($check);
        	
        	$obj = $checking->fetch();

        	if(!$obj) throw new PDOException("ID does not exist in the Database!", 404);

        	//Continue with the script
			$datas = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$datas .= "$key=:$key".",";
	 		}

	 		$data = "";
	 		foreach($model->table_attributes as $key => $value){
	 			$data .= "$key".",";
	 		}

	 		$datas = rtrim($datas, ','); 

	 		$data = rtrim($data, ','); 

			$sql = "UPDATE $model->table SET $datas WHERE ID=$id";

			$explodedDatas = explode(',', $data);
		    
		    foreach ($request->all() as $key => $req) {
		    	if (!in_array($key, $explodedDatas) ) {
		    		unset($_REQUEST[$key]);
		    	}
		    }
			
			$this->dbh->prepare($sql)->execute($request->all());

			$this->closeConnection();

			return true;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function deleteData(string $model, Request $request ,int $id)
	{
		$model = new $model();
		try{
			
			//Check if data exists in the DB
			$check = "SELECT * FROM $model->table WHERE ID = $id";
        	$checking = $this->dbh->query($check);
        	
        	$obj = $checking->fetch();

        	if(!$obj ) throw new PDOException("ID does not exist in the Database!", 1);

        	//Continue with the script
			$sql = "DELETE FROM $model->table WHERE ID=$id";
			
			$this->dbh->prepare($sql)->execute();

			$this->closeConnection();

			return true;
			
		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function rawQueryOne(string $query)
	{
		try{
			$sth = $this->dbh->prepare($query);

			$sth->execute();

			$obj = $sth->fetch(PDO::FETCH_ASSOC);
			
			$this->closeConnection();

			if(!$obj) return null;

			return $obj;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function rawQueryAll(string $query)
	{
		try{
			$sth = $this->dbh->prepare($query);

			$sth->execute();

			$obj = $sth->fetchAll(PDO::FETCH_ASSOC);

			$this->closeConnection();

			if(!$obj) return null;

			return $obj;

		}catch(PDOException $e){

			Logger::error($e);

			throw new Exception( "There is some problem in connection: " . $e->getMessage() , 500);
		}
	}

	public function closeConnection() {
     	$this->dbh = null;
  	}


}