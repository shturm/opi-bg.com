<?php
/* TopMenuItem Test cases generated on: 2011-08-28 00:06:31 : 1314479191*/
App::import('Model', 'TopMenuItem');

class TopMenuItemTestCase extends CakeTestCase {
	var $fixtures = array('app.top_menu_item');

	function startTest() {
		$this->TopMenuItem =& ClassRegistry::init('TopMenuItem');
	}

	function endTest() {
		unset($this->TopMenuItem);
		ClassRegistry::flush();
	}

}
