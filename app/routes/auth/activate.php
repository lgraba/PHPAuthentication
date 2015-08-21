<?php

// activate.php
// Allow the user to activate their account

$app->get('/activate', function() use ($app) {
	
	// Compare hashed GET identifier with database 'active_hash'
	// If they match, activate user by setting database field 'active' to true

	// Grab request data in query string via GET method
	$request = $app->request;
	$email = $request->get('email');
	$identifier = $request->get('identifier');

	// Hash the identifier
	$hashedIdentifier = $app->hash->hash($identifier);

	// Pick up user's account
	$user = $app->user
		->where('email', $email)
		->where('active', false)
		->first();

	// Check if user is found and if hash doesn't match
	if (!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)) {
		$app->flash('global', 'There was a problem activating your account.');
		$app->response->redirect($app->urlFor('home'));
	} else {
		// Activate account using the method in User
		$user->activateAccount();
		// Flash Successful activation message
		$app->flash('global', 'Your account is now active and you may sign in.');
		$app->response->redirect($app->urlFor('home'));
	}

})->name('activate');