<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Sentry_Base extends Controller {
	protected $_tpl = null;

	public function before() {
		$this->_tpl = View::factory('Sentry/layout');

		$this->_tpl->hints = Hint::render(null, true, 'sentry/hint');
	}

	public function after() {
		$this->response->body($this->_tpl->render());
	}

} // End Sentry_Base
