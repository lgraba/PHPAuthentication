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
// User
require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';
// Admin
require INC_ROOT . '/app/routes/admin/example.php';
// Errors
require INC_ROOT . '/app/routes/errors/404.php';