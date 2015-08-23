<?php

// change.php
// A route to allow a user to change their account details

$app->get('/account/profile', $authenticated(), function () use ($app) {
	$app->render('account/profile.php');
})->name('account.profile');

// POST
$app->post('/account/profile', $authenticated(), function () use ($app) {
	
	// Pull in POST request data
	$request = $app->request;
	$email = $request->post('email');
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');

	// Validation
	$v = $app->validation;
	$v->validate([
		'Email' => [$email, 'required|email|uniqueEmail'],
		'First Name' => [$firstName, 'alpha|max(64)'],
		'Last Name' => [$lastName, 'alpha|max(64)']
	]);

	// If validation passes
	if ($v->passes()) {

		// Grab current authenticated user
		$user = $app->auth;

		// Update database entry for the
		$user->update([
			'email' => $email,
			'first_name' => $firstName,
			'last_name' => $lastName
		]);

		// Flash confirmation message
		$app->flash('global', 'Your account details have been updated.');
		// Redirect
		// Note: Redirect to user.profile?
		return $app->response->redirect($app->urlFor('account.profile'));
	}

	$app->render('account/profile.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('account.profile.post');