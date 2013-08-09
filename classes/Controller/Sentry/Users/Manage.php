<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sentry_Users_Manage extends Controller_Sentry_Base {
	public function action_index() {
		//$users = ORM::factory('User')->find_all();
		$users = Sentry::getUserProvider()->findAll();
		$this->_tpl->content = View::factory('sentry/user/manage/list', array('users' => $users));
		$this->response->body($this->_tpl->render());
	}

	public function action_add() {
		$ignore_form = false;
		$content = '';

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

				$user = ORM::factory('User')
					->values($post)
					->save();

				$content .= '<div class="alert alert-success">You\'ve successfully created user "'.$user->id.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				$ignore_form = true;
			}
			catch (ORM_Validation_Exception $e)
			{
				foreach($e->errors('model') as $error)
				{
					$content .= '<div class="alert alert-error">'.$error.' <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				}

			}
		}

		if(!$ignore_form) {
			$content .= View::factory('sentry/user/manage/create',array('groups' => Sentry::getGroupProvider()->findAll(), 'permissions' => Permissions::instance()->all()));
		}


		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_edit() {
		$id = $this->request->param('id');

		$user = ORM::factory('User', $id);

		if (!$user->loaded())
		{
			$content = '<h2 class="text-error pull-left">404.</h2> <h3>No corresponding user found</h3>';
		}
		else {
			$content = '';
			$ignore_form = false;

			if($this->request->post() != null) {
				try
				{
					$post = $this->request->post();

					if(empty($post['password']))
					{
						unset($post['password']);
					}
					//set all posted permissions to 1
					if(array_key_exists('permissions', $post) && count($post['permissions'] > 0)) {
						$list = array();

						foreach($post['permissions'] as $key) {
							$list[$key] = 1;
						}
						$post['permissions'] = $list;
					}

					$user->values($post)
						->save();

					$content .= '<div class="alert alert-success">You\'ve successfully updated user "#'.$user->id.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
					$ignore_form = true;
				}
				catch (ORM_Validation_Exception $e)
				{
					foreach($e->errors('model') as $error)
					{
						$content .= '<div class="alert alert-error">'.$error.' <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
					}

				}
			}

			if(!$ignore_form) {
				$permissions = (is_array($user->permissions)) ? array_keys($user->permissions) : array();
				$groups = Arr::exclude(Sentry::getGroupProvider()->findAll()->as_array(), $user->groups->as_array(), true);
				$content .= View::factory('sentry/user/manage/edit',array('user' => $user, 'groups' => $groups, 'permissions' => Permissions::instance()->split($permissions)));
			}
		}

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_delete() {
		$id = $this->request->param('id');

		$user = ORM::factory('User', $id);

		if (!$user->loaded())
		{
			$content = '<h2 class="text-error pull-left">404.</h2> <h3>No corresponding user found</h3>';
		}
		else {
			$id = $user->id;
			$user->delete();

			$content = '<div class="alert alert-success">You\'ve deleted user "#'.$id.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

} // End Sentry_Groups
