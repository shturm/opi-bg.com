<?php
/* Color Test cases generated on: 2011-08-24 03:49:47 : 1314146987*/
App::import('Model', 'Color');

class ColorTestCase extends CakeTestCase {
	var $fixtures = array('app.color', 'app.color_group', 'app.product', 'app.group', 'app.image', 'app.images_group', 'app.images_product', 'app.order', 'app.user', 'app.orders_product');

	function startTest() {
		$this->Color =& ClassRegistry::init('Color');
	}

	function endTest() {
		unset($this->Color);
		ClassRegistry::flush();
	}

}
