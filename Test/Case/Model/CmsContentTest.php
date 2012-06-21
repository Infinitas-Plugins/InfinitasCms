<?php
App::uses('CmsContent', 'Cms.Model');

/**
 * CmsContent Test Case
 *
 */
class CmsContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.cms.cms_content',
		'plugin.cms.cms_feature',
		'plugin.cms.cms_frontpage',

		'plugin.contents.global_tag',
		'plugin.contents.global_tagged',
		'plugin.contents.global_content',
		'plugin.contents.global_layout',
		'plugin.contents.global_category',
		'plugin.locks.global_lock',
		'plugin.management.ticket',
		'plugin.users.user',
		'plugin.users.group',
		'plugin.installer.plugin',
		'plugin.view_counter.view_counter_view'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CmsContent = ClassRegistry::init('Cms.CmsContent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CmsContent);

		parent::tearDown();
	}

/**
 * @brief get latest
 */
	public function testGetLatest() {
		$expected = array(

		);
		$result = $this->CmsContent->find('latest');
		$this->assertEquals($expected, $result);
	}

/**
 * testGetViewData method
 *
 * @return void
 */
	public function testGetViewData() {
	}
}
