<?php defined('SYSPATH') OR die('No direct access allowed.');

class Kohana_Model_User extends \Cartalyst\Sentry\Users\Kohana\User {

	/**
	 * Set the user's groups (deletes previously stored ones).
	 *
	 * We're using Kohana's add method, not Sentry's addGroup
	 * @see ORM::add
	 */
	public function set_groups(Array $groups)
	{
		//remove all related groups
		$this->remove('groups');

		//add all the new groups
		$this->add('groups', $groups);

		return $this;
	}

	/**
	 * Return a list groups this user does not have.
	 *
	 * @param bool $return_local Also return the groups this user has?
	 * @return array
	 */
	public function not_in_groups($return_local=false)
	{
		$owned = $this->groups->find_all();
		$groups = Sentry::getGroupProvider()->createModel();

		if(count($owned) > 0) {
			$user_group_ids = array();

			foreach($owned as $group) {
				$user_group_ids[] = $group->id;
			}

			if(count($user_group_ids) > 1)
			{
				$groups->where('id', 'NOT_IN', $user_group_ids);
			}
			else
			{
				$groups->where('id', '!=', $user_group_ids[0]);
			}

			if($return_local == false)
				return $groups->find_all();
			else
			{
				return array('joined' => $owned, 'free' => $groups->find_all());
			}
		}

		return array();
	}

} // End User Model