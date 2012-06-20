<?php
/* Contents Test cases generated on: 2009-12-13 19:12:00 : 1260726840*/
App::uses('CmsController', 'Cms.Controller');

class TestCmsController extends CmsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CmsControllerTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.cms.cms_content',
		'plugin.contents.global_category',
		'plugin.cms.cms_frontpage',
		'plugin.configs.config'
	);

	function startTest() {
		$this->Cms = new TestCmsController();
		$this->Cms->constructClasses();
	}

	function endTest() {
		unset($this->Contents);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

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
?>