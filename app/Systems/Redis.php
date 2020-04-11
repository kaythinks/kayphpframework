<?php

namespace App\Systems;

use Predis\Client;

class Redis{
	/**
	 * This property contains a Predis Object
	 * 
	 * @var $client
	 */
	protected $client;

	public function __construct()
	{
		// Parameters passed using a named array:
		$this->client = new Client([
		    'scheme' => 'tcp',
		    'host'   => \App\Config\Env::REDIS_SERVER,
		    'port'   => \App\Config\Env::REDIS_PORT,
		    //'password' => \App\Config\Env::REDIS_PASSWORD //The password can be used if it has been set on the redis server
		]);
	}

	/**
	 * This method is for retrieving a specific value from the Redis server
	 * 
	 * @param  string $name 
	 * @return Response
	 */
	public function getValue( string $name)
	{
		$value = $this->client->get($name);

		return $value;
	}

	/**
	 * This method is for setting a specific value in the Redis server
	 * 
	 * @param string $key   
	 * @param mixed $value 
	 */
	public function setValue(string $key, $value) : bool
	{
		$this->client->set($key, $value);

		return true;
	}

	/**
	 * This method is for getting all keys value
	 * 
	 * @return Response
	 */
	public function getAllValues()
	{
		$value = $this->client->keys("*");
		
		return $value;
	}

	/**
	 * This method is for setting a specific value in the Redis server with an expiry value
	 * 
	 * @param  string $key        
	 * @param  mixed $value     
	 * @param  int    $expiryTime 
	 * @return Boolean           
	 */
	public function setex(string $key, $value,int $expiryTime) : bool
	{
		$this->client->set($key, $value);

		$this->client->expireat($key, time() + $expiryTime); 

		return true;
	}

	/**
	 * This method checks if a key exists in the Redis Server
	 * 
	 * @param  mixed $keyName [description]
	 * @return bool 
	 */ 
	public function checkIfExists($keyName) : bool
	{
		$value = $this->client->exists($keyName); 

		return $value > 0 ? true : false;

	}

	/**
	 * This method is for deleting a key
	 * 
	 * @param  mixed $keyName
	 * @return bool
	 */
	public function flushKeyValue($keyName)
	{
		$this->client->del($keyName); 

		return true;
	}

	/**
	 * This method is for deleting all keys in a Redis database
	 * 
	 * @return bool
	 */
	public function flushAllValues() 
	{
		$this->client->flushDb();

		return true;
	}

}