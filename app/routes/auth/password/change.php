<?php

// change.php
// Route to allow user to change their password

// Password Change Entry Route
$app->get('/change-password', $authenticated(), function() use ($app) {
	$app->render('auth/password/change.php');
})->name('password.change');

// Password Change POST handling route
$app->post('/change-password', $authenticated(), function() use ($app) {

	// Store everything sent via this POST request
	$request = $app->request;

	$currentPassword = $request->post('current_password');
	$newPassword = $request->post('new_password');
	$newPasswordConfirm = $request->post('new_password_confirm');

	// Validation
	$v = $app->validation;
	$v->validate([
		'Current Password' => [$currentPassword, 'required|matchesCurrentPassword'], // Hash password here for validation check
		'new_password' => [$newPassword, 'required|min(6)'],
		'New Password Confirmation' => [$newPasswordConfirm, 'required|matches(new_password)']
	]);

	if ($v->passes()) {

		// Set user variable to the currently logged in user
		$user = $app->auth;

		// Time for Change Password email
		// Could also grab this from the database after the update below, but the difference should be negligible
		$date_time = date('F j, Y \a\t h:i a T');

		// Update database entry using Slim's functionality
		$user->update([
			'password' => $app->hash->password($newPassword)
		]);

		// Send Changed Password email
		$app->mail->send('email/auth/password/change.php', ['date_time' => $date_time], function($message) use ($user) {
			// Set message details
			$message->to($user->email, $user->getFullNameOrUsername());
			$message->subject('Authentication Account Password Changed');
		});

		// Flash global message notification fo Password Change
		$app->flash('global', 'You have changed your password.');
		return $app->response->redirect($app->urlFor('home'));
	}

	// Render the Change Password View while sending it errors
	$app->render('/auth/password/change.php', [
		'errors' => $v->errors()
	]);


})->name('password.change.post');