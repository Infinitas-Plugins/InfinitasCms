<?php
/* ContentFrontpages Test cases generated on: 2009-12-13 19:12:17 : 1260726977*/
App::uses('CmsFrontpagesController', 'Cms.Controller');

class TestCmsFrontpagesController extends CmsFrontpagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CmsFrontpagesControllerTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.cms.cms_frontpage',
		'plugin.cms.cms_content',
		'plugin.contents.global_category',
		'plugin.configs.config'
	);

	function startTest() {
		$this->CmsFrontpages =& new TestCmsFrontpagesController();
		$this->CmsFrontpages->constructClasses();
	}

	function endTest() {
		unset($this->CmsFrontpages);
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