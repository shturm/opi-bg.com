<?php
/* User Test cases generated on: 2011-08-10 02:49:05 : 1312933745*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.order', 'app.product', 'app.group', 'app.image', 'app.images_group', 'app.images_product', 'app.orders_product', 'app.page_load');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
