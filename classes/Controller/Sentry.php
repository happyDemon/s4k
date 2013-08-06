<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sentry extends Controller_Sentry_Base {

	public function action_index()
	{
		$this->_tpl->content = View::factory('sentry/setup');
		$this->response->body($this->_tpl->render());
	}

	public function action_info()
	{
		$this->_tpl->content = View::factory('sentry/info');
		$this->response->body($this->_tpl->render());
	}

} // End Sentry
