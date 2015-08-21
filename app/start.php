<?php

// start.php

// Namespaces
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;
use Logan\User\User;
use Logan\Helpers\Hash;
use Logan\Mail\Mailer;
use Logan\Validation\Validator;
use Logan\Middleware\BeforeMiddleware;
use Logan\Middleware\CsrfMiddleware;

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

// Add our middlewares
$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);

// Actually load configuration into SLim application
$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});


// The order of these requires is important (ex: Filters before Routes because Filters is middleware FOR the routes)
// Database
require 'database.php';
// Filters
require 'filters.php';
// Routes
require 'routes.php';

// Set user session authentication to false
$app->auth = false;

// Container Additions

// Put User model into Slim container
$app->container->set('user', function () {
	return new User;
});
// Put Hash model into SLim container as a singleton (constant)
$app->container->singleton('hash', function() use ($app) {
	return new Hash($app->config);
});
// Put Validation model (now with the user) into Slim container as a singleton (constant)
$app->container->singleton('validation', function() use ($app) {
	return new Validator($app->user);
});
// Put PHPMailer model into Slim container (singleton)
$app->container->singleton('mail', function () use ($app) {

	$mailer = new PHPMailer;

	// Set PHPMailer configuration from config file
	$mailer->isSMTP($app->config->get('mail.smtp'));
	$mailer->Host = $app->config->get('mail.host');
	$mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
	$mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
	$mailer->Port = $app->config->get('mail.port');
	$mailer->Username = $app->config->get('mail.username');
	$mailer->Password = $app->config->get('mail.password');
	$mailer->isHTML($app->config->get('mail.html'));

	$mailer->From = 'lgraba@gmail.com';
 	$mailer->FromName = 'Logan Graba';
 	$mailer->addReplyTo('logangraba@gmail.com', 'Reply Address');

	// Return mailer object
	return new Mailer($app->view, $mailer);

});
// Put RandomLib into Slim container (singleton)
$app->container->singleton('randomlib', function () {
	$factory = new RandomLib;
	return $factory->getMediumStrengthGenerator();
});

// Configure Slim Views with Twig parser
$view = $app->view();
$view->parserOptions = [
	'debug' => $app->config->get('twig.debug')
];
$view->parserExtensions = [
	new TwigExtension
];