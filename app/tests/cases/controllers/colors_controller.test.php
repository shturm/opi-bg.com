<?php
/* Colors Test cases generated on: 2011-08-24 03:54:31 : 1314147271*/
App::import('Controller', 'Colors');

class TestColorsController extends ColorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ColorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.color', 'app.color_group', 'app.product', 'app.group', 'app.image', 'app.images_group', 'app.images_product', 'app.order', 'app.user', 'app.orders_product', 'app.page_load');

	function startTest() {
		$this->Colors =& new TestColorsController();
		$this->Colors->constructClasses();
	}

	function endTest() {
		unset($this->Colors);
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
