<?php

// logout.php
// Log a user out

$app->get('/logout', function () use ($app) {
	
	// Unset SESSION 
	unset($_SESSION[$app->config->get('auth.session')]);

	// Check if cookie is set
	if ($app->getCookie($app->config->get('auth.remember'))) {
		// Remove Rember Me credentials for the user logging out
		$app->auth->removeRememberCredentials();
		// Delete cookie
		$app->deleteCookie($app->config->get('auth.remember'));
	}

	// Flash logout message and redirect user to home
	$app->flash('global', 'You are now logged out...');
	$app->response->redirect($app->urlFor('home'));

})->name('logout');