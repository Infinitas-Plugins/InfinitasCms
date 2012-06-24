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
			'CmsContent' => array(
				'id' => '3',
				'model' => NULL,
				'foreign_key' => NULL,
				'title' => 'What is infinitas',
				'slug' => 'what-is-infinitas',
				'introduction' => NULL,
				'body' => '<p>\\r\\n	Over and above the core of infinitus is an easy to use api so anything that is not included in the core can be added through easy to develop plugins.&nbsp; With infinitas being built using the ever popular CakePHP&nbsp;framework there is countless plugins already developed that can be integrated with little or no modification.</p>\\r\\n<p>\\r\\n	The core of infinitas has been developed using the MVC standard of object orintated design.&nbsp; If you are an amature php deveeloper or a veteran you will find Infinitas easy to follow and even easier to expand on.&nbsp;</p>\\r\\n<p>\\r\\n	Now that you have Infinitas running your web site, you will have time to run your business.</p>\\r\\n',
				'image' => NULL,
				'dir' => NULL,
				'full_text_search' => NULL,
				'keyword_density' => NULL,
				'global_category_id' => NULL,
				'meta_keywords' => NULL,
				'meta_description' => NULL,
				'group_id' => '2',
				'layout_id' => '1',
				'author_id' => NULL,
				'author_alias' => NULL,
				'editor_id' => NULL,
				'editor_alias' => NULL,
				'canonical_url' => NULL,
				'canonical_redirect' => NULL,
				'created' => '2010-01-18 03:37:17',
				'modified' => '2010-04-12 11:28:57',
				'locked' => false,
				'locked_since' => '0000-00-00 00:00:00',
				'locked_by' => '0',
				'ordering' => '1',
				'views' => '30',
				'active' => true,
				'start' => '0000-00-00 00:00:00',
				'end' => '0000-00-00 00:00:00',
				'created_by' => '0',
				'modified_by' => '0',
				'category_id' => '1',
				'rating' => '0',
				'rating_count' => '0',
				'content_image_path_full' => '/contents/img/no-image.png',
				'content_image_path_jumbo' => '/contents/img/no-image.png',
				'content_image_path_large' => '/contents/img/no-image.png',
				'content_image_path_medium' => '/contents/img/no-image.png',
				'content_image_path_small' => '/contents/img/no-image.png',
				'content_image_path_thumb' => '/contents/img/no-image.png',
			),
			'Feature' => array(
				'id' => NULL,
				'content_id' => NULL,
				'ordering' => NULL,
				'order_id' => NULL,
				'created' => NULL,
				'created_by' => NULL,
			),
			'Frontpage' => array(
				'id' => NULL,
				'content_id' => NULL,
				'ordering' => NULL,
				'order_id' => NULL,
				'created' => NULL,
				'modified' => NULL,
			),
			'GlobalContent' => array(
				'id' => NULL,
				'model' => NULL,
				'foreign_key' => NULL,
				'title' => NULL,
				'slug' => NULL,
				'introduction' => NULL,
				'body' => NULL,
				'image' => NULL,
				'dir' => NULL,
				'full_text_search' => NULL,
				'keyword_density' => NULL,
				'global_category_id' => NULL,
				'meta_keywords' => NULL,
				'meta_description' => NULL,
				'group_id' => NULL,
				'layout_id' => NULL,
				'author_id' => NULL,
				'author_alias' => NULL,
				'editor_id' => NULL,
				'editor_alias' => NULL,
				'canonical_url' => NULL,
				'canonical_redirect' => NULL,
				'created' => NULL,
				'modified' => NULL,
			),
			'Layout' => array(
				'id' => NULL,
				'name' => NULL,
				'model' => NULL,
				'auto_load' => NULL,
				'css' => NULL,
				'html' => NULL,
				'php' => NULL,
				'content_count' => NULL,
				'created' => NULL,
				'modified' => NULL,
			),
			'GlobalCategory' => array(
				'id' => NULL,
				'title' => NULL,
				'slug' => NULL,
				'meta_keywords' => NULL,
				'meta_description' => NULL,
				'description' => NULL,
				'active' => NULL,
				'locked' => NULL,
				'locked_since' => NULL,
				'locked_by' => NULL,
				'group_id' => NULL,
				'item_count' => NULL,
				'parent_id' => NULL,
				'lft' => NULL,
				'rght' => NULL,
				'views' => NULL,
				'created' => NULL,
				'modified' => NULL,
			),
			'GlobalCategoryContent' => array(
				'id' => NULL,
				'title' => NULL,
				'slug' => NULL,
				'meta_keywords' => NULL,
				'meta_description' => NULL,
			),
			'ContentGroup' => array(
				'id' => NULL,
				'name' => NULL,
			),
			'ContentEditor' => array(
				'id' => NULL,
				'username' => NULL,
			),
			'ContentAuthor' => array(
				'id' => NULL,
				'username' => NULL,
			),
			'Lock' => array(
				'id' => NULL,
				'class' => NULL,
				'foreign_key' => NULL,
				'user_id' => NULL,
				'created' => NULL,
			),
			'LockLocker' => array(
				'id' => NULL,
				'username' => NULL,
			),
			'GlobalTagged' => NULL,
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
