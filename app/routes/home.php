<?php

// home.php
// Home Route

$app->get('/', function() use ($app) {

	// Render homepage view
	$app->render('home.php');

})->name('home');