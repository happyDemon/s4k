<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sentry_Users_Manage extends Controller_Sentry_Base {
	
	// List all the registered users
	public function action_index() {
		$users = Sentry::getUserProvider()->findAll();
		
		$this->_tpl->content = View::factory('sentry/user/manage/list', array('users' => $users));
	}

	// Show the create user form
	public function action_add() {
		$this->_tpl->content = View::factory('sentry/user/manage/create', array(
			'groups' => Sentry::getGroupProvider()->findAll(),
			'permissions' => Permissions::instance()->all()
			)
		);
	}

	// Try to create a user
	public function action_add_complete() {
		if($this->request->post() != null) {
			try
			{
				$post = $this->request->post();

				//Set all provided permissions to 1
				if(array_key_exists('permissions', $post) && count($post['permissions'] > 0)) {
					$list = array();

					foreach($post['permissions'] as $key) {
						$list[$key] = 1;
					}
					$post['permissions'] = $list;
				}

				$user = $user = Sentry::getUserProvider()->createModel()
					->values($post)
					->save();

				Hint::set(Hint::SUCCESS, 'You\'ve successfully created user "'.$user->id);
				$this->redirect(Route::url('sentry.users.manage', null, true));
			}
			catch (ORM_Validation_Exception $e)
			{
				foreach($e->errors('model') as $error)
				{
					Hint::set(Hint::ERROR, $error);
				}
			}

			$this->_tpl->hints = Hint::render(null, true, 'sentry/hint');
			$this->action_add();
		}
		else
			$this->redirect(Route::url('sentry.users.manage.add', null, true));
	}

	// Show the edit user form
	public function action_edit($user=null) {
		$id = $this->request->param('id');

		try {
			$user = ($user != null) ? $user : Sentry::getUserProvider()->findById($id);
			$permissions = (is_array($user->permissions)) ? array_keys($user->permissions) : array();

			//split up the user groups
			$groups = $user->not_in_groups(true);

			$this->_tpl->content = View::factory('sentry/user/manage/edit', array(
				'user' => $user,
				'groups' => $groups,
				'permissions' => Permissions::instance()->split($permissions)
				)
			);
		}
		catch( \Cartalyst\Sentry\Users\UserNotFoundException $e) {
			Hint::set(Hint::ERROR, 'No corresponding user found');
			$this->redirect(Route::url('sentry.users.manage', null, true));
		}
	}

	// Try to edit a user
	public function action_edit_complete() {
		$id = $this->request->param('id');

		try {
			if($this->request->post() != null) {
				$user = Sentry::getUserProvider()->findById($id);

				try
				{
					$post = $this->request->post();
					$values = array('email', 'password', 'first_name', 'last_name', 'permissions');
					if(empty($post['password']))
					{
						unset($post['password']);
						unset($values[1]);
					}
					//set all posted permissions to 1
					if(array_key_exists('permissions', $post) && count($post['permissions'] > 0)) {
						$list = array();

						foreach($post['permissions'] as $key) {
							$list[$key] = 1;
						}
						$post['permissions'] = $list;
					}

					$user->values($post, $values)
						->save();

					if(count($post['groups']) > 0)
					{
						$user->set_groups($post['groups']);
					}

					Hint::set(Hint::SUCCESS, 'You\'ve successfully updated user "#'.$user->id);
					$this->redirect(Route::url('sentry.users.manage', null, true));
				}
				catch (ORM_Validation_Exception $e)
				{
					foreach($e->errors('model') as $error)
					{
						Hint::set(Hint::ERROR, $error);
					}
				}

				$this->_tpl->hints = Hint::render(null, true, 'sentry/hint');
				$this->action_edit($user);
			}
			else
			{
				$this->redirect(Route::url('sentry.users.manage.edit', array('id' => $id), true));
			}
		}
		catch( \Cartalyst\Sentry\Users\UserNotFoundException $e) {
			Hint::set(Hint::ERROR, 'No corresponding user found');
			$this->redirect(Route::url('sentry.users.manage', null, true));
		}
	}

	// Try to delete a user
	public function action_delete() {
		$id = $this->request->param('id');

		try {
			$user = Sentry::getUserProvider()->findById($id);
			$id = $user->id;
			$user->delete();

			Hint::set(Hint::SUCCESS, 'You\'ve deleted user "#'.$id);
			$this->redirect(Route::url('sentry.users.manage', null, true));
		}
		catch( \Cartalyst\Sentry\Users\UserNotFoundException $e) {
			Hint::set(Hint::ERROR, 'No corresponding user found');
			$this->redirect(Route::url('sentry.users.manage', null, true));
		}
	}

} // End Sentry_Users_Manage
