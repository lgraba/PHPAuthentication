<?php

// logout.php
// Log a user out

$app->get('/logout', function () use ($app) {
	
	// Unset SESSION 
	unset($_SESSION[$app->config->get('auth.session')]);

	// Flash logout message and redirect user to home
	$app->flash('global', 'You are now logged out...');
	$app->response->redirect($app->urlFor('home'));

})->name('logout');