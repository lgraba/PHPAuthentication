<?php

// BeforeMiddleware.php

// Set namespace
namespace Logan\Middleware;

// Use Slim Middleware namespace
use Slim\Middleware;

class BeforeMiddleware extends Middleware
{

	public function call()
	{
		// Before ever Slim application request, run a method
		$this->app->hook('slim.before', [$this, 'run']);

		// Send it on to the next call
		$this->next->call();
	}

	public function run()
	{
		// Check to see if the SESSION variable is set
		if (isset($_SESSION[$this->app->config->get('auth.session')])) {
			// If it is set, do a database check and set user record accordingly
			$this->app->auth = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
		}

		$this->app->view()->appendData([
			'auth' => $this->app->auth,
			'baseUrl' => $this->app->config->get('app.url')
		]);
	}

}