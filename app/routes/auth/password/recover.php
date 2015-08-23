<?php

// recover.php
// A route for recovering a user's password

$app->get('/recover-password', $guest(), function () use ($app) {
	$app->render('auth/password/recover.php');
})->name('password.recover');

// Form Submission POST Handling
$app->post('/recover-password', $guest, function() use ($app) {
	
	// Pull in POST request
	$request = $app->request;
	// Set POST request email to email variable
	$email = $request->post('Email');

	// Instantiate new validation
	$v = $app->validation;
	// Input validation arguments
	$v->validate([
		'Email' => [$email, 'required|email']
	]);

	// If validation passes
	if ($v->passes()) {

		// Grab user with matching email address from database
		$user = $app->user->where('email', $email)->first();

		if (!$user) {
			// Note: In the future, possibly add custom validation rule instead of the flash
			// Flash notification
			$app->flash('global', 'Did you forget your email address too?');
			// Redirect to /recover-password to all them another try
			return $app->response->redirect($app->urlFor('password.recover'));
		} else {

			// Generate random string
			$identifier = $app->randomlib->generateString(128);

			// Hash string and store in database
			$user->update([
				'recover_hash' => $app->hash->hash($identifier)
			]);

			// Send email with identifier link
			$app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
				// Construct message
				$message->to($user->email, $user->getFullNameOrUsername());
				$message->subject('Recover Your Authentication Account Password');
			});


			// Flash notification for sent email
			$app->flash('global', 'An email with instructions on how to recover your password has been sent to ' . $user->email);
			// Redirect home
			return $app->response->redirect($app->urlFor('home'));
		}

	}

	// If validation doesn't pass, render the same form with errors and request data passed to the view/form
	$app->render('auth/password/recover.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('password.recover.post');