![GitHub](https://img.shields.io/badge/SEMVER-1.0.1-brightgreen)
![GitHub](https://img.shields.io/badge/code%20coverage-90%25-orange)
[![GitHub license](https://img.shields.io/badge/LICENSE-MIT-blue)](https://github.com/kaythinks/kayphpframework/blob/master/LICENSE.md)

# KayPHP Framework
<p align="center">
  <img src="https://raw.githubusercontent.com/kaythinks/kayphpframework/master/public/kayphplogo.png" width="256" title="KayPHP">
</p>

A light weight PHP MVC Framework that get's the Job done.

# Installation

Run 
```
$ composer create-project --prefer-dist kaythinks/kayphpframework mywebproject
```

Or run 
```
$ git clone https://github.com/kaythinks/kayphpframework.git mywebproject
```

# STARTING

		Run the following to start the server and enjoy application
		~ php - S localhost:7777 
		~ composer install 
		~ composer dump-autoload
		~ Change the EnvExample.php file to Env.php and change the class name to Env

# TESTING
    Run in the root folder :
    vendor/bin/phpunit Tests/ExampleTest.php

# COMMANDS
    To migrate tables, run :
    composer migrate tables

    To seed data, run :
    composer seed tables    

    To run queues, run :
    composer queue mails
    NOTE: You are advised to run "php app/Systems/Queues/MailQueueProcessor.php" if you are trying to queue multiple processes as composer times out after some time.

# SUPPORTS
<span>
<h1>Redis Caching</h1>
<img src="https://redis.io/images/redis-white.png" width="200" title="Redis">
<h1>Cloudinary File Upload</h1>
<img src="https://cloudinary-res.cloudinary.com/image/upload/v1538583988/cloudinary_logo_for_white_bg.svg" width="200"  title="Cloudinary">
<h1>RabbitMQ Queueing</h1>
<img src="https://www.rabbitmq.com/img/RabbitMQ-logo.svg" width="200" title="RabbitMQ">
<h1>PHPUnit Testing</h1>
<img src="https://phpunit.de/img/phpunit.png" width="200" title="PHPUnit">
<h1>PHP Mailer</h1>
<img src="https://camo.githubusercontent.com/0d858d6dac4d3f6fab7d42de2c09d32ee2de9c5b/68747470733a2f2f7261772e6769746875622e636f6d2f5048504d61696c65722f5048504d61696c65722f6d61737465722f6578616d706c65732f696d616765732f7068706d61696c65722e706e67" width="200" title="PHPMailer">
</span>