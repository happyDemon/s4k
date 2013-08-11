<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_Controller_S4K_Base extends Controller {
	protected $_tpl = null;

	public function before() {
		$this->_tpl = View::factory('s4k/layout');

		$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
	}

	public function after() {
		$this->response->body($this->_tpl->render());
	}

} // End Sentry_Base
