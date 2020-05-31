<?php

namespace App\Config;

class EnvExample {

	//KayPHP Ships with mysql access by default
	const DB_HOST = "127.0.0.1";
	const DB_USER = "root";
	const DB_NAME = "";
	const DB_PASSWORD = "";
	const DB_DRIVER = "mysql";
	const APP_KEY = "";
	const SESSION_EXPIRY_TIME = 120; //It should be in seconds
	const TIME_ZONE = 'Africa/Lagos';

	//Mail Settings
	const MAIL_HOST = "smtp.mailtrap.io";
	const MAIL_HOST_USERNAME = "";  
	const MAIL_HOST_PASSWORD = ""; 
	const MAIL_ENCRYPTION = "tls";
	const MAIL_FROM_ADDRESS = "dummymail@gmail.com";
	const MAIL_FROM_NAME = "Kay PHP";
	const MAIL_PORT = 2525;

	//Redis Setting
	const REDIS_SERVER = "127.0.0.1";
	const REDIS_PORT = 6379;
	const REDIS_PASSWORD = " ";

	//Cloudinary Settings
	const CLOUDINARY_CLOUD_NAME = "";
	const CLOUDINARY_API_KEY = "";
	const CLOUDINARY_API_SECRET = "";
	const CLOUDINARY_URL = "";

	//RabbitMQ Settings
	const RABBITMQ_HOST = "127.0.0.1";
	const RABBITMQ_PORT = 5672;
	const RABBITMQ_USERNAME = "guest";
	const RABBITMQ_PASSWORD = "guest";
	const ENVIRONMENT = "testing"; //"testing" or "production"
}