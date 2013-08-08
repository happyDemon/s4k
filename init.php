<?php defined('SYSPATH') or die('No direct script access.');

Route::set('sentry.setup', 'sentry')
	->defaults(array(
		'controller' => 'Sentry',
		'action'     => 'index'
	)
);
Route::set('sentry.info', 'sentry/info')
	->defaults(array(
		'controller' => 'Sentry',
		'action'     => 'info'
	)
);

Route::set('sentry.users.register', 'sentry/register')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'register'
	)
);

Route::set('sentry.users.login', 'sentry/login')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'login'
	)
);
Route::set('sentry.users.activate', 'sentry/activate')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'activate'
	)
);
Route::set('sentry.users.reset', 'sentry/reset')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset'
	)
);
Route::set('sentry.users.reset_valid', 'sentry/reset/validate')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset_valid'
	)
);
Route::set('sentry.groups', 'sentry/groups')
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'index'
	)
);
Route::set('sentry.groups.add', 'sentry/groups/add')
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'add'
	)
);
Route::set('sentry.groups.edit', 'sentry/groups/<id>/edit', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'edit',
		'id'         => null
	)
);
Route::set('sentry.groups.delete', 'sentry/groups/<id>/delete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'delete',
		'id'         => null
	)
);
Route::set('sentry.permissions', 'sentry/permissions')
	->defaults(array(
		'controller' => 'Sentry',
		'action'     => 'permissions'
	)
);