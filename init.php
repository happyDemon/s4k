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
Route::set('sentry.users.register.complete', 'sentry/register/complete')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'register_complete'
	)
);
Route::set('sentry.users.login', 'sentry/login')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'login'
	)
);
Route::set('sentry.users.login.complete', 'sentry/login/complete')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'login_complete'
	)
);
Route::set('sentry.users.activate', 'sentry/activate')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'activate'
	)
);
Route::set('sentry.users.activate.complete', 'sentry/activate/complete')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'activate_complete'
	)
);
Route::set('sentry.users.reset', 'sentry/reset')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset'
	)
);
Route::set('sentry.users.reset.complete', 'sentry/reset/complete')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset_complete'
	)
);
Route::set('sentry.users.reset_valid', 'sentry/reset/validate')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset_valid'
	)
);
Route::set('sentry.users.reset_valid.complete', 'sentry/reset/validate/complete')
	->defaults(array(
		'controller' => 'Sentry_User',
		'action'     => 'reset_valid_complete'
	)
);
Route::set('sentry.users.manage', 'sentry/users/manage')
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'index'
	)
);
Route::set('sentry.users.manage.add', 'sentry/users/manage/add')
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'add'
	)
);
Route::set('sentry.users.manage.add.complete', 'sentry/users/manage/add/complete')
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'add_complete'
	)
);
Route::set('sentry.users.manage.edit', 'sentry/users/manage/<id>/edit', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'edit',
		'id'         => null
	)
);
Route::set('sentry.users.manage.edit.complete', 'sentry/users/manage/<id>/edit/complete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'edit_complete',
		'id'         => null
	)
);
Route::set('sentry.users.manage.delete', 'sentry/users/manage/<id>/delete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Users_Manage',
		'action'     => 'delete',
		'id'         => null
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
Route::set('sentry.groups.add.complete', 'sentry/groups/add/complete')
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'add_complete'
	)
);
Route::set('sentry.groups.edit', 'sentry/groups/<id>/edit', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'edit',
		'id'         => null
	)
);
Route::set('sentry.groups.edit.complete', 'sentry/groups/<id>/edit/complete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'Sentry_Groups',
		'action'     => 'edit_complete',
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