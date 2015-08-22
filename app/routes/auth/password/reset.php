<?php

// reset.php
// A form to reset the user's password

$app->get('/password-reset', $guest(), function() use ($app) {

	// Restrict access to correct email and identifier
	// Grab request data from URL
	$request = $app->request();
	// Set request data to variables
	$email = $request->get('email');
	$identifier = $request->get('identifier');

	// Hash the identifier
	$hashedIdentifier = $app->hash->hash($identifier);

	// Select user from database by email
	$user = $app->user->where('email', $email)->first();

	// Redirect to home if...
	// No user found in database with that particular email
	if (!$user) {
		$app->response->redirect($app->urlFor('home'));
	}
	// If the user doesn't have a recover_hash
	if (!$user->recover_hash) {
		$app->response->redirect($app->urlFor('home'));
	}
	// Or if the hash doesn't match the database
	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
		$app->response->redirect($app->urlFor('home'));
	}

	// Render the reset form view, making email and hash variables available to it
	// We will retain them in the URL for ease of validation, but can probably find a way to transmit them via the form
	$app->render('auth/password/reset.php', [
		'user' => $user,
		'identifier' => $identifier
	]);

})->name('password.reset');

$app->post('/password-reset', $guest(), function() use ($app) {

	// Store everything sent via this POST request
	$request = $app->request;

	// Set request data to variables
	$email = $request->get('email'); // From URL
	$identifier = $request->get('identifier'); // From URL
	$newPassword = $request->post('new_password');
	$newPasswordConfirm = $request->post('new_password_confirm');

	// Hash the identifier
	$hashedIdentifier = $app->hash->hash($identifier);

	// Select user from database by email
	$user = $app->user->where('email', $email)->first();

	// Redirect to home if...
	// No user found in database with that particular email
	if (!$user) {
		$app->response->redirect($app->urlFor('home'));
	}
	// If the user doesn't have a recover_hash
	if (!$user->recover_hash) {
		$app->response->redirect($app->urlFor('home'));
	}
	// Or if the hash doesn't match the database
	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
		$app->response->redirect($app->urlFor('home'));
	}

	// Validation
	$v = $app->validation;
	$v->validate([
		'new_password' => [$newPassword, 'required|min(6)'],
		'New Password Confirmation' => [$newPasswordConfirm, 'required|matches(new_password)']
	]);

	if ($v->passes()) {

		// Time for Password Reset email
		// Could also grab this from the database after the update below, but the difference should be negligible
		$date_time = date('F j, Y \a\t h:i a T');

		// Update database entry using Slim's functionality
		$user->update([
			'password' => $app->hash->password($newPassword),
			'recover_hash' => null
		]);

		// Send Password Reset email
		$app->mail->send('email/auth/password/reset.php', ['date_time' => $date_time], function($message) use ($user) {
			// Set message details
			$message->to($user->email, $user->getFullNameOrUsername());
			$message->subject('Authentication Account Password Reset');
		});

		// Flash global message notification fo Password Change
		$app->flash('global', 'You have reset your password and may now log in.');
		$app->response->redirect($app->urlFor('login'));
	}

	// Render the Change Password View while sending it errors
	$app->render('/auth/password/reset.php', [
		'user' => $user,
		'identifier' => $identifier,
		'errors' => $v->errors()
	]);

})->name('password.reset.post');