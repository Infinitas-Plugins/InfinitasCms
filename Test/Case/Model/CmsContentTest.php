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
		'plugin.comments.infinitas_comment',
		'plugin.locks.lock',
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
		$expected = array (
			'CmsContent' => array(
				'id' => 'cms-content-1',
				'model' => 'Cms.CmsContent',
				'foreign_key' => 'cms-content-1',
				'title' => 'Cms Content 1',
				'slug' => 'cms-content-1',
				'introduction' => 'Cms Content 1 introduction',
				'body' => 'Cms Content 1 body',
				'image' => 'category.png',
				'dir' => 'content-cms-1',
				'full_text_search' => 'cms content introduction body',
				'keyword_density' => '1.000',
				'global_category_id' => null,
				'meta_keywords' => 'cms, one',
				'meta_description' => 'Category three meta description',
				'group_id' => '0',
				'layout_id' => 'cms-layout',
				'author_id' => 'user-1',
				'author_alias' => '',
				'editor_id' => null,
				'editor_alias' => '',
				'canonical_url' => '/cms/content-cms-1',
				'canonical_redirect' => true,
				'created' => '2012-03-24 08:38:08',
				'modified' => '2012-03-24 08:38:08',
				'ordering' => '1',
				'views' => '30',
				'active' => true,
				'start' => '0000-00-00 00:00:00',
				'end' => '0000-00-00 00:00:00',
				'created_by' => '0',
				'modified_by' => '0',
				'category_id' => '1',
				'rating' => '0.00',
				'rating_count' => '0',
				'comment_count' => null,
				'content_image_path_full' => '/files/global_content/image/content-cms-1/category.png',
				'content_image_path_jumbo' => '/files/global_content/image/content-cms-1/jumbo_category.png',
				'content_image_path_large' => '/files/global_content/image/content-cms-1/large_category.png',
				'content_image_path_medium' => '/files/global_content/image/content-cms-1/medium_category.png',
				'content_image_path_small' => '/files/global_content/image/content-cms-1/small_category.png',
				'content_image_path_thumb' => '/files/global_content/image/content-cms-1/thumb_category.png',
			),
			'Feature' => array(
				'id' => 'cms-feature-1',
				'content_id' => 'cms-content-1',
				'ordering' => '1',
				'order_id' => '1',
				'created' => '2010-01-04 21:49:03',
			),
			'Frontpage' => array(
				'id' => null,
				'content_id' => null,
				'ordering' => null,
				'order_id' => null,
				'created' => null,
				'modified' => null,
			),
			'GlobalContent' => array(
				'id' => 'content-cms-1',
				'model' => 'Cms.CmsContent',
				'foreign_key' => 'cms-content-1',
				'title' => 'Cms Content 1',
				'slug' => 'cms-content-1',
				'introduction' => 'Cms Content 1 introduction',
				'body' => 'Cms Content 1 body',
				'image' => 'category.png',
				'dir' => 'content-cms-1',
				'full_text_search' => 'cms content introduction body',
				'keyword_density' => '1.000',
				'global_category_id' => null,
				'meta_keywords' => 'cms, one',
				'meta_description' => 'Category three meta description',
				'group_id' => '0',
				'layout_id' => 'cms-layout',
				'author_id' => 'user-1',
				'author_alias' => '',
				'editor_id' => null,
				'editor_alias' => '',
				'canonical_url' => '/cms/content-cms-1',
				'canonical_redirect' => true,
				'created' => '2012-03-24 08:38:08',
				'modified' => '2012-03-24 08:38:08',
			),
			'Layout' => array(
				'id' => null,
				'name' => null,
				'model' => null,
				'auto_load' => null,
				'css' => null,
				'html' => null,
				'php' => null,
				'content_count' => null,
				'created' => null,
				'modified' => null,
				'theme_id' => null,
				'layout' => null,
			),
			'GlobalCategory' => array(
				'id' => null,
				'title' => null,
				'slug' => null,
				'meta_keywords' => null,
				'meta_description' => null,
				'active' => null,
				'group_id' => null,
				'item_count' => null,
				'parent_id' => null,
				'lft' => null,
				'rght' => null,
				'views' => null,
				'created' => null,
				'modified' => null,
				'hide' => null,
				'path_depth' => null,
			),
			'GlobalCategoryContent' => array(
				'id' => null,
				'title' => null,
				'slug' => null,
				'meta_keywords' => null,
				'meta_description' => null,
			),
			'ContentGroup' => array(
				'id' => null,
				'name' => null,
			),
			'ContentEditor' => array(
				'id' => null,
				'username' => null,
			),
			'ContentAuthor' => array(
				'id' => null,
				'username' => null,
			),
			'Lock' => array(
				'id' => null,
				'class' => null,
				'foreign_key' => null,
				'user_id' => null,
				'created' => null,
			),
			'LockLocker' => array(
				'id' => null,
				'username' => null,
			),
			'GlobalTagged' => null,
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
