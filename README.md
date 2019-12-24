# KayPHP Framework

A light weight PHP MVC Framework that get's the Job done.

# Installation

Run  ~~  composer create-project --prefer-dist kaythinks/kayphpframework mywebproject

# Starting

		Run the following to start the server and enjoy application
		~ php - S localhost:7777 
		~ composer install 
		~ composer dump-autoload

# Testing
    Run in the root folder :
    vendor/bin/phpunit Tests/ExampleTest.php

# Commands
    To migrate tables, run :
    composer migrate tables

    To seed data, run :
    composer seed tables    