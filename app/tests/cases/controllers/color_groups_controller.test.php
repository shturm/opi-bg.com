<?php
/* ColorGroups Test cases generated on: 2011-08-24 03:54:16 : 1314147256*/
App::import('Controller', 'ColorGroups');

class TestColorGroupsController extends ColorGroupsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ColorGroupsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.color_group', 'app.color', 'app.product', 'app.group', 'app.image', 'app.images_group', 'app.images_product', 'app.order', 'app.user', 'app.orders_product', 'app.page_load');

	function startTest() {
		$this->ColorGroups =& new TestColorGroupsController();
		$this->ColorGroups->constructClasses();
	}

	function endTest() {
		unset($this->ColorGroups);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
