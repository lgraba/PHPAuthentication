<?php

// profile.php
// Show user details

$app->get('/u/:username', function($username) use ($app) {

	// Look up user in database
	$user = $app->user->where('username', $username)->first();

	// If the user is not found, show 404
	if(!$user) {
		$app->notFound();
	}

	$app->render('user/profile.php', [
		'user' => $user
	]);

})->name('user.profile');