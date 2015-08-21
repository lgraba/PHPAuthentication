<?php

// CsrfMiddleware
// Cross-site Request Forgery Middleware
// Generate csrf tokens, check csrf tokens, then just need to implement in each form on site

namespace Logan\Middleware;

use Exception;
use Slim\Middleware;

class CsrfMiddleware extends Middleware
{

	protected $key;

	public function call()
	{
		// Pull in key we're going to use for this token
		$this->key = $this->app->config->get('csrf.key');
		// Attach hook before request, look inside this class object and perform method check
		$this->app->hook('slim.before', [$this, 'check']);
		// This is required by Slim Middleware
		$this->next->call();
	}

	public function check()
	{

		// If the CSRF key is not set, then generate it
		if (!isset($_SESSION[$this->key])) {
			// Generate key by calling hash helper hash function, passing a random string into it
			$_SESSION[$this->key] = $this->app->hash->hash(
				$this->app->randomlib->generateString(128)
			);
		}

		// Grab hashed session key for comparison
		$token = $_SESSION[$this->key];

		// If the request is POST, PUT, or DELETE
		if (in_array($this->app->request()->getMethod(), ['POST', 'PUT', 'DELETE'])) {
			// Set submittedToken to the CSRF key if it is available via POST, otherwise set to an empty string
			$submittedToken = $this->app->request()->post($this->key) ?: '';
			
			// Compare submitted token with that in our session and throw an exception if they don't match
			if (!$this->app->hash->hashCheck($token, $submittedToken)) {
				throw new Exception('CSRF token mismatch');
			}
		}

		// Share the key and token with our form view
		$this->app->view()->appendData([
			'csrf_key' => $this->key, // From config
			'csrf_token' => $token // From SESSION
		]);

	}

}