<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Controller_S4K_Groups extends Controller_S4K_Base {

	// List all the created groups
	public function action_index() {
		$groups = Sentry::getGroupProvider()->createModel()->find_all();

		$this->_tpl->content = View::factory('s4k/groups/list', array('groups' => $groups));
	}

	// Show the create group form
	public function action_add() {
		$this->_tpl->content = View::factory('s4k/groups/create',array('permissions' => Permissions::instance()->all()));
	}

	// Try to create a group
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

				//Save the new group
				$group = Sentry::getGroupProvider()->createModel()
					->values($post)
					->save();

				//set a success message an redirect to the management page
				Hint::set(Hint::SUCCESS, 'You\'ve successfully created group "'.$group->name.'"');
				$this->redirect(Route::url('S4K.groups', null, true));
			}
			catch (ORM_Validation_Exception $e)
			{
				//Make hints out of the errors
				foreach($e->errors('orm') as $error)
				{
					Hint::set(Hint::ERROR, $error);
				}
			}

			//No success saving the group, show the form again with the errors
			$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
			$this->action_add();
		} //No post request, redirect back to the create group page
		else
			$this->redirect(Route::url('S4K.groups.add', null, true));
	}

	// Show the edit group form
	public function action_edit($group = null) {
		$id = $this->request->param('id');

		try {
			$group = ($group == null) ? Sentry::getGroupProvider()->findById($id): $group;

			//get the permission names of this group
			$permissions = (is_array($group->permissions)) ? array_keys($group->permissions) : array();

			$this->_tpl->content = View::factory('s4k/groups/edit', array(
				'group' => $group,
				'permissions' => Permissions::instance()->split($permissions)
				)
			);
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
			//set an error message an redirect to the management page
			Hint::set(Hint::ERROR, 'No corresponding group found');
			$this->redirect(Route::url('S4K.groups', null, true));
		}
	}

	// Try to edit a group
	public function action_edit_complete() {
		$id = $this->request->param('id');

		try {
			$group = Sentry::getGroupProvider()->findById($id);

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

					//save the group
					$group->values($post)
						->save();

					//set a success message an redirect to the management page
					Hint::set(Hint::SUCCESS, 'You\'ve successfully updated group "'.$group->name.'"');
					$this->redirect(Route::url('S4K.groups', null, true));
				}
				catch (ORM_Validation_Exception $e)
				{
					//Make hints out of the errors
					foreach($e->errors('model') as $error)
					{
						Hint::set(Hint::ERROR, $error);
					}
				}

				//No success saving the group, show the form again with the errors
				$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
				$this->action_edit($group);
			}
			else //No post request, redirect back to the edit group page
				$this->redirect(Route::url('S4K.groups.edit', array('id' => $id), true));
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
			//set an error message an redirect to the management page
			Hint::set(Hint::ERROR, 'No corresponding group found');
			$this->redirect(Route::url('S4K.groups', null, true));
		}
	}

	// Try to delete a group
	public function action_delete() {
		$id = $this->request->param('id');

		try {
			$group = Sentry::getGroupProvider()->findById($id);

			$name = $group->name;
			$group->delete();

			//set a success message an redirect to the management page
			Hint::set(Hint::SUCCESS, 'You\'ve deleted group "'.$name.'"');
			$this->redirect(Route::url('S4K.groups', null, true));
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
			//set an error message an redirect to the management page
			Hint::set(Hint::ERROR, 'No corresponding group found');
			$this->redirect(Route::url('S4K.groups', null, true));
		}
	}

} // End Sentry_Groups
