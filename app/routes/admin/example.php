<?php

// example.php
// A route for an example Administrator area

// Note usage of $admin() here, defined in /app/filters.php
$app->get('/admin/example', $admin(), function() use ($app) {
	$app->render('admin/example.php');
})->name('admin.example');