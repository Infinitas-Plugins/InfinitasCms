<?php
App::uses('CmsFeature', 'Cms.Model');

/**
 * CmsFeature Test Case
 *
 */
class CmsFeatureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.cms.cms_feature',
		'plugin.cms.cms_content',
		'plugin.cms.cms_frontpage'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CmsFeature = ClassRegistry::init('Cms.CmsFeature');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CmsFeature);

		parent::tearDown();
	}

/**
 * @brief test validation
 */
	public function testValidation() {
		$expected = false;
		$result = $this->CmsFeature->save(array());
		$this->assertEquals($expected, $result);

		$expected = array('content_id' => array('Please select the content item that should be featured'));
		$result = $this->CmsFeature->validationErrors;
		$this->assertEquals($expected, $result);

		$date = date('Y-m-d H:i:s');
		$expected = array('CmsFeature' => array('id' => '2', 'content_id' => 2, 'ordering' => 2, 'created' => $date));
		$result = $this->CmsFeature->save(array('created' => $date, 'content_id' => 2));
		$this->assertEquals($expected, $result);
	}

/**
 * @brief test behaviors
 */
	public function testBehaviors() {
		$expected = false;
		$result = in_array('Thrashable', $this->CmsFeature->Behaviors->attached());
		$this->assertEquals($expected, $result, 'Thrash should not be attached to this model');
	}
}
