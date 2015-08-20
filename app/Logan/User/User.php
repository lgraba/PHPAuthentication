<?php

// User.php
// User Model using Eloquent

// Set namespace of the User class
namespace Logan\User;

// Use Eloquent namespace
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	protected $table = 'users';

	protected $fillable = [
		'email',
		'username',
		'password',
		'active',
		'active_hash',
		'remember_identifier',
		'remember_token'
	];
}