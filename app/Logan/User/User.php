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

	public function getFullName()
	{
		// Check if current Model state does not have first or last name present
		if (!$this->first_name || !$this->last_name) {
			return null;
		}
		// If it does, return first and last name in Twig markup
		return "{$this->first_name} {$this->last_name}";
	}

	public function getFullNameOrUsername()
	{
		return $this->getFullName() ?: $this->username;
	}

}