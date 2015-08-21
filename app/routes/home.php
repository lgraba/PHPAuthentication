<?php

// home.php
// Home Route

$app->get('/', function() use ($app) {

	echo $app->randomlib->generateString(128);

	// Render homepage view
	$app->render('home.php');

})->name('home');

// Flash registration message
/*
$app->get('/flash', function() use ($app) {
	$app->flash('global', 'You have registered! Please check your email for confirmation code.');
	$app->response->redirect($app->urlFor('home'));
});
*/