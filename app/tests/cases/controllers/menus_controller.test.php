<?php
/* Menus Test cases generated on: 2011-08-27 18:52:40 : 1314460360*/
App::import('Controller', 'Menus');

class TestMenusController extends MenusController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MenusControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.menu', 'app.menu_item', 'app.page_load', 'app.user', 'app.order', 'app.product', 'app.group', 'app.color', 'app.color_group', 'app.orders_product');

	function startTest() {
		$this->Menus =& new TestMenusController();
		$this->Menus->constructClasses();
	}

	function endTest() {
		unset($this->Menus);
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
