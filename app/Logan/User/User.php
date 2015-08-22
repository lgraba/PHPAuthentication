<?php

// User.php
// User Model using Eloquent

// Set namespace of the User class
namespace Logan\User;

// Use Eloquent namespace
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	// The Users table
	protected $table = 'users';
	// Fillable quantities in this model
	protected $fillable = [
		'email',
		'username',
		'password',
		'active',
		'active_hash',
		'recover_hash',
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

	// Update database to activate an account
	public function activateAccount()
	{
		// Set 'active' to true and delete 'active_hash' in database
		$this->update([
			'active' => true,
			'active_hash' => null
		]);
	}

	// For pulling in Gravatar URL
	public function getAvatarUrl($options = [])
	{
		// Set size from options passed through if it is set, otherwise a standard size of 45
		$size = isset($options['size']) ? $options['size']: 45;
		// Return the Gravatar URL with md5-hashed email address and size option appended on
		// Default Gravatar set to retro
		return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=retro';
	}

	// Set identifier and token for Remember Me in database
	public function setRememberCredentials($identifier, $token)
	{
		$this->update([
			'remember_identifier' => $identifier,
			'remember_token' => $token
		]);
	}

	// Remove identifier and token for Remember Me from database
	public function removeRememberCredentials()
	{
		$this->setRememberCredentials(null, null);
	}

	// Check if User has certain permission
	public function hasPermission($permission)
	{
		return (bool) $this->permissions->{$permission};
	}

	// Helper method for is_admin permission
	public function isAdmin()
	{
		return $this->hasPermission('is_admin');
	}

	// Relate User Model to User Permissions Model
	public function permissions()
	{
		// Each User has only one UserPermission associated with it, operating with foreign key user_id
		// Note: this relational mapping automatically matches on the foreign key, I believe
		return $this->hasOne('Logan\User\UserPermission', 'user_id');
	}

}