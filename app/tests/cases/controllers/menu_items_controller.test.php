<?php
/* MenuItems Test cases generated on: 2011-08-27 19:03:18 : 1314460998*/
App::import('Controller', 'MenuItems');

class TestMenuItemsController extends MenuItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MenuItemsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_item', 'app.menu', 'app.page_load', 'app.user', 'app.order', 'app.product', 'app.group', 'app.color', 'app.color_group', 'app.orders_product');

	function startTest() {
		$this->MenuItems =& new TestMenuItemsController();
		$this->MenuItems->constructClasses();
	}

	function endTest() {
		unset($this->MenuItems);
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
