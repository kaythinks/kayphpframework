![GitHub](https://img.shields.io/badge/SEMVER-1.0.1-brightgreen)
![GitHub](https://img.shields.io/badge/code%20coverage-90%25-orange)
[![GitHub license](https://img.shields.io/badge/LICENSE-MIT-blue)](https://github.com/kaythinks/kayphpframework/blob/master/LICENSE.md)

# KayPHP Framework

![KayPHP Logo](https://raw.githubusercontent.com/kaythinks/kayphpframework/master/public/kayphplogo.png)


A light weight PHP MVC Framework that get's the Job done.

# Installation

Run
```
$ composer create-project --prefer-dist kaythinks/kayphpframework mywebproject
```
# Starting

		Run the following to start the server and enjoy application
		~ php - S localhost:7777 
		~ composer install 
		~ composer dump-autoload
		~ Change the EnvExample.php file to Env.php

# Testing
    Run in the root folder :
    vendor/bin/phpunit Tests/ExampleTest.php

# Commands
    To migrate tables, run :
    composer migrate tables

    To seed data, run :
    composer seed tables    