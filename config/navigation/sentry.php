<?php defined('SYSPATH' OR die('No direct access allowed.'));
/**
 * Sentry navigation header
 */
return array(
	'view' => 'bootstrap/navbar',
	'items'             => array(
		array(
			'route'     => 'sentry.setup',
			'title'   => 'Setup'
		),
		array(
			'route'     => 'sentry.info',
			'title'   => 'Info'
		),
		array(
			'title'   => 'Users',
			'url' => '#',
			'items' => array(
				array(
					'route'     => 'sentry.users.register',
					'title'   => 'Register'
				),
				array(
					'route'     => 'sentry.users.activate',
					'title'   => 'Activate'
				),
				array(
					'route'     => 'sentry.users.login',
					'title'   => 'Login'
				),
				array(
					'route'     => 'sentry.users.reset',
					'title'   => 'Reset password'
				)
			)
		),
		array(
			'title'   => 'Groups',
			'route' => 'sentry.groups'
		),
		array(
			'title'   => 'Permissions',
			'route' => 'sentry.permissions'
		)
	),
);