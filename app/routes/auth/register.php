<?php

// register.php
// Registration Form Route

// Registration Form Entry Route
$app->get('/register', $guest(), function() use ($app) {
	$app->render('/auth/register.php');
})->name('register');

// Registration POST Handling Route
$app->post('/register', $guest(), function() use ($app) {

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

		// Random String identifier
		$identifier = $app->randomlib->generateString(128);

		// Create database entry using Slim's functionality
		$user = $app->user->create([ // Necessary to assign this to variable for user in sending registration email
			'email' => $email,
			'username' => $username,
			'password' => $app->hash->password($password),
			'active' => false,
			'active_hash' => $app->hash->hash($identifier)
		]);


		// Send registration email
		$app->mail->send('email/auth/register.php', ['user' => $user, 'identifier' => $identifier], function($message) use ($user) {
			// Set message details
			$message->to($user->email, $user->getFullNameOrUsername());
			$message->subject('Thanks for registering with Authentication, ' . $user->getFullNameOrUsername() . '!');
		});

		// Flash global message notification
		$app->flash('global', 'You have been registered! Please check your email to activate your account.');
		$app->response->redirect($app->urlFor('home'));
	}

	// Render the Register View while sending it errors and request
	$app->render('/auth/register.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);


})->name('register.post');