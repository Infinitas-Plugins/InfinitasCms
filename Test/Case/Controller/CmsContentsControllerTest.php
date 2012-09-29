<?php
App::uses('CmsContentsController', 'Cms.Controller');

/**
 * CmsContentsController Test Case
 *
 */
class CmsContentsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.cms.cms_content',
		'plugin.contents.global_category',
		'plugin.contents.global_content',
		'plugin.contents.global_layout',
		'plugin.contents.global_tagged',
		'plugin.contents.global_tag',
		'plugin.users.group',
		'plugin.themes.theme',
		'plugin.users.user',
		'plugin.view_counter.view_counter_view',
		'plugin.comments.infinitas_comment',
		'plugin.comments.infinitas_comment_attribute'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {
	}

}
