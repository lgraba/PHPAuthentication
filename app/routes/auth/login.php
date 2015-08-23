<?php

// login.php
// Allow the user to Login!

// Use carbon for datetime parsing (in setting cookie for Remember Me)
use Carbon\Carbon;

$app->get('/login', $guest(), function () use ($app) {

	$app->render('auth/login.php');

})->name('login');

// POST data handling on form submission
$app->post('/login', $guest(), function () use ($app) {

	$request = $app->request;
	// Set variables for all form-submitted POST data
	$identifier = $request->post('identifier');
	$password = $request->post('password');
	$remember = $request->post('remember'); // Is this name or id attribute?

	// Validation
	// Note the capitalization - It's just easier than creating custom error messages
	$v = $app->validation;
	$v->validate([
		'Identifier' => [$identifier, 'required'],
		'Password' => [$password, 'required']
	]);

	if ($v->passes()) {
		// Eloquent-style database OR query
		$user = $app->user
			->where(function ($query) use ($identifier) {
				$query->where('username', $identifier)
					  ->orWhere('email',  $identifier);
			})
			->where('active', true)
			->first();
		// Used grouping to make this query: "SELECT * FROM `users` WHERE (username = '[username]' OR email = '[email]') AND active = true"

		// Only allows user to sign in with username:
			// ->where('username', $identifier)
			// ->orWhere('email', $identifier)
			// ->where('active', true) // Having a problem here - if user logs in with username, it does not check to see if active=true
			// ->first();

		// If the User exists AND Passwords match (see passwordCheck in Logan\Helpers\Hash.php)
		if ($user && $app->hash->passwordCheck($password, $user->password)) {

			// Set Session name to user id
			$_SESSION[$app->config->get('auth.session')] = $user->id;

			// Check if 'Remember Me' has been checked
			if ($remember === 'on') {

				// Generate remember identifier
				$rememberIdentifier = $app->randomlib->generateString(128);
				// Generate remember token
				$rememberToken = $app->randomlib->generateString(128);

				// Store remember identifier and hashed remember token in database
				$user->setRememberCredentials(
					$rememberIdentifier,
					$app->hash->hash($rememberToken)
				);

				// Use Slim's setCookie to create a new cookie
				// name of cookie
				// data values, separated by ___
				// Expiry (using carbon datetime parsing)
				$app->setCookie(
					$app->config->get('auth.remember'),
					"{$rememberIdentifier}___{$rememberToken}",
					Carbon::parse('+1 week')->timestamp
				);

			}

			// Flash a message at the top and redirect to Home
			$app->flash('global', 'You are now logged in...');
			return $app->response->redirect($app->urlFor('home'));

		} else {

			// Flash a message at the top and redirect to Login
			$app->flash('global', 'Could not log you in!');
			return $app->response->redirect($app->urlFor('login'));

		}
	}

	// Render Login View and pass data through to it
	$app->render('auth/login.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);
	
})->name('login.post');