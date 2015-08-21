<?php

// login.php
// Allow the user to Login!

$app->get('/login', $guest(), function () use ($app) {

	$app->render('auth/login.php');

})->name('login');

// POST data handling on form submission
$app->post('/login', $guest(), function () use ($app) {

	$request = $app->request;

	$identifier = $request->post('identifier');
	$password = $request->post('password');

	// Validation
	// Note the capitalization - It's just easier than creating custom error messages
	$v = $app->validation;
	$v->validate([
		'Identifier' => [$identifier, 'required'],
		'Password' => [$password, 'required']
	]);

	if ($v->passes()) {
		// Slim database OR query
		$user = $app->user
			->where('username', $identifier)
			->orWhere('email', $identifier)
			->where('active', true)
			->first();

		// If the User exists AND Passwords match (see passwordCheck in Logan\Helpers\Hash.php)
		if ($user && $app->hash->passwordCheck($password, $user->password)) {

			// Set Session name to user id
			$_SESSION[$app->config->get('auth.session')] = $user->id;

			// Flash a message at the top and redirect to Home
			$app->flash('global', 'You are now logged in...');
			$app->response->redirect($app->urlFor('home'));

		} else {

			// Flash a message at the top and redirect to Login
			$app->flash('global', 'Could not log you in!');
			$app->response->redirect($app->urlFor('login'));

		}
	}

	// Render Login View and pass data through to it
	$app->render('auth/login.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);
	
})->name('login.post');