<?php defined('SYSPATH') or die('No direct script access.');

Route::set('S4K.setup', 'S4K')
	->defaults(array(
		'controller' => 'S4K',
		'action'     => 'index'
	)
);
Route::set('S4K.info', 'S4K/info')
	->defaults(array(
		'controller' => 'S4K',
		'action'     => 'info'
	)
);

Route::set('S4K.users.register', 'S4K/register')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'register'
	)
);
Route::set('S4K.users.register.complete', 'S4K/register/complete')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'register_complete'
	)
);
Route::set('S4K.users.login', 'S4K/login')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'login'
	)
);
Route::set('S4K.users.login.complete', 'S4K/login/complete')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'login_complete'
	)
);
Route::set('S4K.users.activate', 'S4K/activate')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'activate'
	)
);
Route::set('S4K.users.activate.complete', 'S4K/activate/complete')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'activate_complete'
	)
);
Route::set('S4K.users.reset', 'S4K/reset')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'reset'
	)
);
Route::set('S4K.users.reset.complete', 'S4K/reset/complete')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'reset_complete'
	)
);
Route::set('S4K.users.reset_valid', 'S4K/reset/validate')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'reset_valid'
	)
);
Route::set('S4K.users.reset_valid.complete', 'S4K/reset/validate/complete')
	->defaults(array(
		'controller' => 'S4K_User',
		'action'     => 'reset_valid_complete'
	)
);
Route::set('S4K.users.manage', 'S4K/users/manage')
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'index'
	)
);
Route::set('S4K.users.manage.add', 'S4K/users/manage/add')
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'add'
	)
);
Route::set('S4K.users.manage.add.complete', 'S4K/users/manage/add/complete')
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'add_complete'
	)
);
Route::set('S4K.users.manage.edit', 'S4K/users/manage/<id>/edit', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'edit',
		'id'         => null
	)
);
Route::set('S4K.users.manage.edit.complete', 'S4K/users/manage/<id>/edit/complete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'edit_complete',
		'id'         => null
	)
);
Route::set('S4K.users.manage.delete', 'S4K/users/manage/<id>/delete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Users_Manage',
		'action'     => 'delete',
		'id'         => null
	)
);
Route::set('S4K.groups', 'S4K/groups')
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'index'
	)
);
Route::set('S4K.groups.add', 'S4K/groups/add')
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'add'
	)
);
Route::set('S4K.groups.add.complete', 'S4K/groups/add/complete')
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'add_complete'
	)
);
Route::set('S4K.groups.edit', 'S4K/groups/<id>/edit', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'edit',
		'id'         => null
	)
);
Route::set('S4K.groups.edit.complete', 'S4K/groups/<id>/edit/complete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'edit_complete',
		'id'         => null
	)
);
Route::set('S4K.groups.delete', 'S4K/groups/<id>/delete', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'S4K_Groups',
		'action'     => 'delete',
		'id'         => null
	)
);
Route::set('S4K.permissions', 'S4K/permissions')
	->defaults(array(
		'controller' => 'S4K',
		'action'     => 'permissions'
	)
);