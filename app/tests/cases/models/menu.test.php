<?php
/* Menu Test cases generated on: 2011-08-27 18:49:53 : 1314460193*/
App::import('Model', 'Menu');

class MenuTestCase extends CakeTestCase {
	var $fixtures = array('app.menu', 'app.menu_item');

	function startTest() {
		$this->Menu =& ClassRegistry::init('Menu');
	}

	function endTest() {
		unset($this->Menu);
		ClassRegistry::flush();
	}

}
