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

	// Create database entry using Slim's functionality
	$app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $app->hash->password($password)
	]);

	// Flash global message notification
	$app->flash('global', 'You have been registered!');
	$app->response->redirect($app->urlFor('home'));

})->name('register.post');