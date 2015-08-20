<?php

// register.php
// Registration Form Route

// Registration Form Entry Route
$app->get('/register', function() use ($app) {
	$app->render('/auth/register.php');
})->name('register');

// Registration POST Handling Route
$app->post('/register', function() use ($app) {

	// Store everything sent via this POST request
	$request = $app->request;

	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	// Validation
	// I can change the identifiers back to lowercase letters and just add custom error messages for each argument validated over
	// See Validator.php, too
	$v = $app->validation;
	$v->validate([
		'Email' => [$email, 'required|email|uniqueEmail'],
		'Username' => [$username, 'required|alnumDash|max(32)|uniqueUsername'],
		'Password' => [$password, 'required|min(6)'],
		'Password Confirmation' => [$passwordConfirm, 'required|matches(Password)']
	]);

	if ($v->passes()) {
		// Create database entry using Slim's functionality
		$app->user->create([
			'email' => $email,
			'username' => $username,
			'password' => $app->hash->password($password)
		]);

		// Flash global message notification
		$app->flash('global', 'You have been registered!');
		$app->response->redirect($app->urlFor('home'));
	}

	// Render the Register View while sending it errors and request
	$app->render('/auth/register.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);


})->name('register.post');