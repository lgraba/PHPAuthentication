<?php

// UserPermission.php
// A Model for User Permissions

// User namespace
namespace Logan\User;

// Use Eloquent namespace to allow extension of Eloquent Model
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPermission extends Eloquent
{

	// The User Permissions table
	protected $table = 'users_permissions';
	// Fillable quantities in this model
	protected $fillable = [
		'is_admin'
	];

	// Default values for when a user registers
	public static $defaults = [
		'is_admin' => false
	];

}