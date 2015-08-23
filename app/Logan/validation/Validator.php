<?php

// Validator.php
// A custom validation class extending Alex Garrett's Violin

// Set namespace
namespace Logan\Validation;

// Use Logan User namespace
use Logan\User\User;
// Use Logan Helpers Hash namespace
use Logan\Helpers\Hash;
// Use Violin namespace
use Violin\Violin;

class Validator extends Violin
{

	protected $user; // Any user
	protected $hash; // Our hash class object
	protected $auth; // Currently logged in user

	// Upon instantiation accept User model argument
	public function __construct(User $user, Hash $hash, $auth = null)
	{
			$this->user = $user;
			$this->hash = $hash;
			$this->auth = $auth;

			// CUSTOM VALIDATION ERROR MESSAGES
			// I should change the identifiers back to lowercase letters and just add custom error messages for each argument validated over
			// See routes register.php, login.php, and password/change if I do this

			// Add custom error field messages (appear before any rules messages) for uniqueEmail, uniqueUsername
			$this->addFieldMessages([
				'Email' => [
					'uniqueEmail' => 'Email in use. ',
					// Custom error message for built-in validation argument 'email'
					'email' => 'This should be a valid email address.'
				],
				'Username' => [
					'uniqueUsername' => 'Username in use. Try another.'
				],
				'new_password' => [ // Relabeled to be compliant with matches()
					'min' => 'New Password must be a minimum of 6 characters.',
					'required' => 'New Password required.'
				],
				'New Password Confirmation' => [ // matches() will not take an argument with spaces
					'matches' => 'New Password Confirmation must match New Password.'
				]
			]);

			// Add custom error message for matchesCurrentPassword rule
			$this->addRuleMessages([
				'matchesCurrentPassword' => 'Current Password is incorrect.'
			]);
	}

	public function validate_uniqueEmail($value, $input, $args)
	{
		// Use Eloquent query to select users from database matching email
		$user = $this->user->where('Email', $value);

		if ($this->auth && $this->auth->email === $value) {
			return true;
		}

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

	// Match submitted password to current password in database for /password/change.php
	public function validate_matchesCurrentPassword($value, $input, $args)
	{
		// Return true if user signed in and the inputted value matches that signed in user's password
		return ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) ? true : false;
	}

}