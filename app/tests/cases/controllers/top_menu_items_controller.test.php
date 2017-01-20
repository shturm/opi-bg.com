<?php
/* TopMenuItems Test cases generated on: 2011-08-28 01:06:54 : 1314482814*/
App::import('Controller', 'TopMenuItems');

class TestTopMenuItemsController extends TopMenuItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TopMenuItemsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.top_menu_item', 'app.page_load', 'app.user', 'app.order', 'app.product', 'app.group', 'app.color', 'app.color_group', 'app.orders_product');

	function startTest() {
		$this->TopMenuItems =& new TestTopMenuItemsController();
		$this->TopMenuItems->constructClasses();
	}

	function endTest() {
		unset($this->TopMenuItems);
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
