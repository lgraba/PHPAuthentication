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
		// Before every Slim application request, run a method
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

		// Append data to view for usage by twig markup
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

			if (empty(trim($data)) || count($credentials) !== 2) {
				// This code sets up a redirect loop - this redirect will again trigger slim.before, recursively redirecting to home if the credential data is altered
				// $this->app->response->redirect($this->app->urlFor('home'));
			} else {
				// Grab identifier credential from array
				$identifier = $credentials[0];
				// Grab token credential from array and hash it up
				$token = $this->app->hash->hash($credentials[1]);

				// Query database for user with matching remember_identifier
				$user = $this->app->user
					->where('remember_identifier', $identifier)
					->first();

				if ($user) {
					// Check to see if our hashed cookie token matches the remember_token in database
					if ($this->app->hash->hashCheck($token, $user->remember_token)) {

						$this->app->flash('global', 'TEST');
						// Log user in:
						// Set SESSION to the user id
						$_SESSION[$this->app->config->get('auth.session')] = $user->id;
						// Set auth to the corresponding user
						$this->app->auth = $this->app->user->where('id', $user->id)->first();

					} else {
						$user->removeRememberCredentials();
					}
				}

			}
		}
	}

}