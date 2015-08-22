<?php

// 404.php
// A custom File Not Found route

$app->notFound(function() use ($app) {
	$app->render('errors/404.php');
});