# PHP Authentication
My work on a tutorial by Alex Garrett (Codecourse). Thanks Alex!

## Dependencies
1. [Slim](https://github.com/slimphp/Slim)
2. [Slim Views](https://github.com/slimphp/Slim-Views)
3. [Twig](https://github.com/twigphp/Twig)
4. [PHPMailer](https://github.com/PHPMailer/PHPMailer)
5. [Hassankhan Config](https://packagist.org/packages/hassankhan/config)
6. [Violin](https://github.com/alexgarrett/violin)
7. [Illuminate Database](https://github.com/illuminate/database)
8. [IRCMaxell RandomLib](https://packagist.org/packages/ircmaxell/random-lib)

*Check the Composer file, composer.json, for the dependency list with versions*


## Getting it Goin'
You should only need to create a configuration file in /app/config/ with your own parameters.

Example configuration file:

```
<?php

// /app/config/development.php
// Development Configuration

return [

	'app' => [
		'url' => 'http://localhost/',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		]
	],

	'db' => [
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'name' => 'site',
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => ''
	],

	'auth' => [
		'session' => 'user_id',
		'remember' => 'user_r'
	],

	'mail' => [
		'smtp_auth' => true,
		'smtp_secure' => 'tls',
		'host' => 'smtp.gmail.com',
		'username' => 'example@gmail.com',
		'password' => 'email_password',
		'port' => '587',
		'html' => true
	],

	'twig' => [
		'debug' => true
	],

	'csrf' => [
		'session' => 'csrf_token'
	]

];

?>
```

Change mode.php to reference the appropriate configuration file name. In this case, it would be called development.php and have the follow text:

```
development
```

## Up Next
I am going to continue with validation using Alex Garrett's Violin validation package according to his tutorial. I will then create the rest of the routes and views and add some CSS via SASS/SCSS.