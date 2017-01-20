<?php
/* MenuItem Test cases generated on: 2011-08-27 18:50:15 : 1314460215*/
App::import('Model', 'MenuItem');

class MenuItemTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_item', 'app.menu');

	function startTest() {
		$this->MenuItem =& ClassRegistry::init('MenuItem');
	}

	function endTest() {
		unset($this->MenuItem);
		ClassRegistry::flush();
	}

}
