<?php

// filters.php
// Route middleware to filter out users' access
// Example: A logged in user should not be able to access the login or register pages
// Note: Our protection is made to be attached to ROUTES

$authenticationCheck = function($required) use ($app) {
	return function() use ($required, $app) {
		// If user is not logged in and we pass true (IS required), or if the user is logged in and we pass false (IS NOT required)...
		if ((!$app->auth && $required) || ($app->auth && !$required)) {
			// Grab the username to use in the flash message if the user is logged in
			$u = $app->auth->username;
			// Kick em out of the protected route back to home, flash a silly message
			$app->flash('global', 'You shan\'t by allowed there! Try navigating using the sexy navigation menu, ' . $u . ' :)');
			$app->redirect($app->urlFor('home'));
		}
	};
};

// For routes that should be accessible only by a logged in user (ex: Administrative area)
$authenticated = function() use ($authenticationCheck) {
	return $authenticationCheck(true);
};

// For routes that should be accessible only by a guest (ex: Login and Registration pages)
$guest = function() use ($authenticationCheck) {
	return $authenticationCheck(false);
};

// For routes that should be accessible only by administrator
$admin = function() use ($app) {
	return function() use ($app) {

		// If they are not logged in, or are not an Administrator
		if (!$app->auth || !$app->auth->isAdmin()) {
			// Flash message and redirect to home
			$app->flash('global', 'You are not an Administator.');
			$app->redirect($app->urlFor('home'));
			
		}
	};	
};