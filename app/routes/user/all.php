<?php

// all.php
// List all users (public)

$app->get('/users', $admin(), function() use ($app) {

	// Look up all users in database
	$users = $app->user->where('active', true)->get();

	// Render view
	$app->render('user/all.php', [
		'users' => $users
	]);

})->name('user.all');