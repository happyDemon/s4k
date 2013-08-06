<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Sentry_Base extends Controller {
	protected $_tpl = null;

	public function before() {
		$this->_tpl = View::factory('Sentry/layout');
	}

} // End Sentry_Base
