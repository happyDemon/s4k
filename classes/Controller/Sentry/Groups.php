<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sentry_Groups extends Controller_Sentry_Base {
	public function action_index() {
		$groups = ORM::factory('Group')->find_all();
		$this->_tpl->content = View::factory('sentry/groups/list', array('groups' => $groups));
		$this->response->body($this->_tpl->render());
	}

	public function action_add() {
		$ignore_form = false;
		$content = '';

		if($this->request->post() != null) {
			try
			{
				$post = $this->request->post();

				//Set all provied permissions to 1
				if(array_key_exists('permissions', $post) && count($post['permissions'] > 0)) {
					$list = array();

					foreach($post['permissions'] as $key) {
						$list[$key] = 1;
					}
					$post['permissions'] = $list;
				}

				$group = ORM::factory('Group')
					->values($post)
					->save();

				$content .= '<div class="alert alert-success">You\'ve successfully created group "'.$group->name.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
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
			$content .= View::factory('sentry/groups/create',array('permissions' => Permissions::instance()->all()));
		}


		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_edit() {
		$id = $this->request->param('id');

		$group = ORM::factory('Group', $id);

		if (!$group->loaded())
		{
			$content = '<h2 class="text-error pull-left">404.</h2> <h3>No corresponding group found</h3>';
		}
		else {
			$content = '';
			$ignore_form = false;

			if($this->request->post() != null) {
				try
				{
					$post = $this->request->post();

					//set all posted permissions to 1
					if(array_key_exists('permissions', $post) && count($post['permissions'] > 0)) {
						$list = array();

						foreach($post['permissions'] as $key) {
							$list[$key] = 1;
						}
						$post['permissions'] = $list;
					}

					$group->values($post)
						->save();

					$content .= '<div class="alert alert-success">You\'ve successfully updated group "'.$group->name.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
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
				$permissions = (is_array($group->permissions)) ? array_keys($group->permissions) : array();
				$content .= View::factory('sentry/groups/edit',array('group' => $group, 'permissions' => Permissions::instance()->split($permissions)));
			}
		}

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_delete() {
		$id = $this->request->param('id');

		$group = ORM::factory('Group', $id);

		if (!$group->loaded())
		{
			$content = '<h2 class="text-error pull-left">404.</h2> <h3>No corresponding group found</h3>';
		}
		else {
			$name = $group->name;
			$group->delete();

			$content = '<div class="alert alert-success">You\'ve deleted group "'.$name.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

} // End Sentry_Groups
