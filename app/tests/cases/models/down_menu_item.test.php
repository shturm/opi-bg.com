<?php
/* DownMenuItem Test cases generated on: 2011-08-28 13:30:08 : 1314527408*/
App::import('Model', 'DownMenuItem');

class DownMenuItemTestCase extends CakeTestCase {
	var $fixtures = array('app.down_menu_item');

	function startTest() {
		$this->DownMenuItem =& ClassRegistry::init('DownMenuItem');
	}

	function endTest() {
		unset($this->DownMenuItem);
		ClassRegistry::flush();
	}

}
