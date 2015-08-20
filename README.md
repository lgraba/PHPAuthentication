README.md

PHP Authorization

Just a quick little thang.

EXAMPLE configuration file in Authentication/app/config/
You may have things like development.php, production.php, etc. as config files.

<?php

// development.php
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


Change Authentication/mode.php to reference the appropriate configuration file name.