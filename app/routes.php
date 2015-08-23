<?php

// routes.php
// Include all routes here

// Home Page
require INC_ROOT . '/app/routes/home.php';
// Authorization
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';
require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';
// User
require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';
// Account
require INC_ROOT . '/app/routes/account/profile.php';
// Admin
require INC_ROOT . '/app/routes/admin/example.php';
// Errors
require INC_ROOT . '/app/routes/errors/404.php';