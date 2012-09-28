<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('CmsHelper', 'Cms.View/Helper');

/**
 * CmsHelper Test Case
 *
 */
class CmsHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->Cms = new CmsHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cms);

		parent::tearDown();
	}

/**
 * testHomePageItem method
 *
 * @return void
 */
	public function testHomePageItem() {
	}

}
