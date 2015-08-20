<?php

// start.php

// Use Slim namespace
use Slim\Slim;
// Use Twig namespace
use Slim\Views\Twig;
// Use TwigExtension namespace
use Slim\Views\TwigExtension;
// Use Noodlehaus (Hassankhan Config) namespace
use Noodlehaus\Config;
// Use Logan namespace for User
use Logan\User\User;
// Use Logan namespace for Hash
use Logan\Helpers\Hash;

// Turn on PHP error reporting
ini_set('display_errors', 'On');

// Start Sessions
session_cache_limiter(false);
session_start();

// Define include root
define('INC_ROOT', dirname(__DIR__));

// Load composer dependencies
require INC_ROOT . '/vendor/autoload.php';

// Instatiate SLim with configuration variable "mode"
$app = new Slim([
	'mode' => file_get_contents(INC_ROOT . '/mode.php'),
	'view' => new Twig(),
	'templates.path' => INC_ROOT . '/app/views'
]);

// Actually load configuration into SLim application
$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

// Database
require 'database.php';
// Routes
require 'routes.php';

// Put User model into Slim container
$app->container->set('user', function () {
	return new User;
});

// Put Hash model into SLim container as a singleton (constant)
$app->container->singleton('hash', function() use ($app) {
	return new Hash($app->config);
});

// Configure Slim Views with Twig parser
$view = $app->view();
$view->parserOptions = [
	'debug' => $app->config->get('twig.debug')
];
$view->parserExtensions = [
	new TwigExtension
];
