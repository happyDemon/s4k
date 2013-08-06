<?php defined('SYSPATH' OR die('No direct access allowed.'));
/**
 * Sentry config file
 */
return array(
	/**
	 * S4K setup
	 */
	'throttle' => true,
	'throttle_attempts' => 5, //Maximum amount of consecutive failed login tries
	'throttle_suspension_time' => '5', // in minutes

	/**
	 * Sentry specific setup
	 */
	'session_driver' => 'native', //native or database @see Kohana_Session::instance()
	'session_key' => 'cartalyst_sentry',
	'cookie_key' => 'cartalyst_sentry',
	'hasher' => 'Bcrypt' //Bcrypt, Native or Sha256
);