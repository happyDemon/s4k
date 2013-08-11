<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Controller_S4K extends Controller_S4K_Base {

	public function action_index()
	{
		$this->_tpl->content = View::factory('s4k/setup');
		$this->response->body($this->_tpl->render());
	}

	public function action_info()
	{
		$this->_tpl->content = View::factory('s4k/info');
		$this->response->body($this->_tpl->render());
	}

	public function action_permissions()
	{
		$this->_tpl->content = View::factory('s4k/permissions');
		$this->response->body($this->_tpl->render());
	}

} // End Sentry
