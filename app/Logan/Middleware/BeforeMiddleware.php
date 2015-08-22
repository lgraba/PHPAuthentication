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

		// Check Remember Me credentials (cookie : database) before every request to application
		$this->checkRememberMe();

		$this->app->view()->appendData([
			'auth' => $this->app->auth,
			'baseUrl' => $this->app->config->get('app.url')
		]);
	}

	protected function checkRememberMe()
	{
		// See if cookie available
		if ($this->app->getCookie($this->app->config->get('auth.remember')) && !$this->app->auth) {

			// Grab cookie data within data_r
			$data = $this->app->getCookie($this->app->config->get('auth.remember'));
			// Separate cookie data by ___
			$credentials = explode('___', $data);

			// if (empty(trim($data)) || count($credentials) !== 2) {
			// 	$this->app->response->redirect($this->app->urlFor('home'));
			// }
		}
	}

}