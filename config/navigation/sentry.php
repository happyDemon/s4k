<?php defined('SYSPATH' OR die('No direct access allowed.'));
/**
 * Sentry navigation header
 */
return array(
	'view' => 'bootstrap/navbar',
	'items'             => array(
		array(
			'route'     => 'S4K.setup',
			'title'   => 'Setup'
		),
		array(
			'route'     => 'S4K.info',
			'title'   => 'Info'
		),
		array(
			'title'   => 'Users',
			'url' => '#',
			'items' => array(
				array(
					'route'     => 'S4K.users.register',
					'title'   => 'Register'
				),
				array(
					'route'     => 'S4K.users.activate',
					'title'   => 'Activate'
				),
				array(
					'route'     => 'S4K.users.login',
					'title'   => 'Login'
				),
				array(
					'route'     => 'S4K.users.reset',
					'title'   => 'Reset password'
				),
				array(
					'route'     => 'S4K.users.manage',
					'title'   => 'Manage'
				)
			)
		),
		array(
			'title'   => 'Groups',
			'route' => 'S4K.groups'
		),
		array(
			'title'   => 'Permissions',
			'route' => 'S4K.permissions'
		)
	),
);