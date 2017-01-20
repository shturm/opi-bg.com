<?php
/* DownMenuItems Test cases generated on: 2011-08-28 13:30:23 : 1314527423*/
App::import('Controller', 'DownMenuItems');

class TestDownMenuItemsController extends DownMenuItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DownMenuItemsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.down_menu_item', 'app.page_load', 'app.user', 'app.order', 'app.product', 'app.group', 'app.color', 'app.color_group', 'app.orders_product');

	function startTest() {
		$this->DownMenuItems =& new TestDownMenuItemsController();
		$this->DownMenuItems->constructClasses();
	}

	function endTest() {
		unset($this->DownMenuItems);
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
