<?php
App::uses('CmsFrontpage', 'Cms.Model');

/**
 * CmsFrontpage Test Case
 *
 */
class CmsFrontpageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.cms.cms_frontpage',
		'plugin.cms.cms_content',
		'plugin.cms.cms_feature'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CmsFrontpage = ClassRegistry::init('Cms.CmsFrontpage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CmsFrontpage);

		parent::tearDown();
	}

/**
 * @brief test validation
 */
	public function testValidation() {
		$expected = false;
		$result = $this->CmsFrontpage->save(array());
		$this->assertEquals($expected, $result);

		$expected = array('content_id' => array('Please select an item to be on the main cms page'));
		$result = $this->CmsFrontpage->validationErrors;
		$this->assertEquals($expected, $result);

		$date = date('Y-m-d H:i:s');
		$expected = array('CmsFrontpage' => array('content_id' => 2, 'modified' => $date, 'created' => $date, 'ordering' => 2));
		$result = $this->CmsFrontpage->save(array('modified' => $date, 'created' => $date, 'content_id' => 2));
		unset($result['CmsFrontpage']['id']);
		$this->assertEquals($expected, $result);
	}

/**
 * @brief test behaviors
 */
	public function testBehaviors() {
		$expected = false;
		$result = in_array('Thrashable', $this->CmsFrontpage->Behaviors->attached());
		$this->assertEquals($expected, $result, 'Thrash should not be attached to this model');
	}
}
