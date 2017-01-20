<?php
/* ColorGroup Test cases generated on: 2011-08-24 03:49:09 : 1314146949*/
App::import('Model', 'ColorGroup');

class ColorGroupTestCase extends CakeTestCase {
	var $fixtures = array('app.color_group', 'app.color', 'app.product', 'app.group', 'app.image', 'app.images_group', 'app.images_product', 'app.order', 'app.user', 'app.orders_product');

	function startTest() {
		$this->ColorGroup =& ClassRegistry::init('ColorGroup');
	}

	function endTest() {
		unset($this->ColorGroup);
		ClassRegistry::flush();
	}

}
