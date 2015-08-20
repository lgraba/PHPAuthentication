<?php

// Validator.php
// A custom validation class extending Alex Garrett's Violin

// Set namespace
namespace Logan\Validation;

// User Logan User namespace
use Logan\User\User;
// Use Violin namespace
use Violin\Violin;

class Validator extends Violin
{
	// Upon instantiation accept User model argument
	public function __construct(User $user)
	{
			$this->user = $user;

			// Add custom error message for uniqueEmail and uniqueUsername
			$this->addFieldMessages([
				'Email' => [
					'uniqueEmail' => 'Email in use. ',
					// Custom error message for built-in validation argument 'email'
					// I can change the identifiers back to lowercase letters and just add custom error messages for each argument validated over
					// See routes register.php, too
					'email' => 'This should be a valid email address.'
				],
				'Username' => [
					'uniqueUsername' => 'Username in use. Try another.'
				]
			]);
	}

	public function validate_uniqueEmail($value, $input, $args)
	{
		// Use Eloquent query to select users from database matching email
		$user = $this->user->where('Email', $value);
		// Return FALSE if there is a user with the same email, TRUE if email unique
		return ! (bool) $user->count();
	}

	public function validate_uniqueUsername($value, $input, $args)
	{
		// Use Eloquent query to select users from database matching username
		$user = $this->user->where('Username', $value);
		// Return FALSE if there is a user with the same username, TRUE if username unique
		return ! (bool) $user->count();
	}

}