<?php
App::uses('CmsBehavior', 'Cms.Model/Behavior');

/**
 * CmsBehavior Test Case
 *
 */
class CmsBehaviorTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cms = new CmsBehavior();
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

	public function testSomething() {
		
	}

}
