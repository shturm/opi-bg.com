<?php
/* Images Test cases generated on: 2011-08-22 23:57:44 : 1314046664*/
App::import('Controller', 'Images');

class TestImagesController extends ImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.image', 'app.group', 'app.product', 'app.color', 'app.images_product', 'app.order', 'app.user', 'app.orders_product', 'app.images_group', 'app.page_load');

	function startTest() {
		$this->Images =& new TestImagesController();
		$this->Images->constructClasses();
	}

	function endTest() {
		unset($this->Images);
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
