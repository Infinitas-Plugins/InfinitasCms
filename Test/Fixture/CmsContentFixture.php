<?php
/**
 * @brief fixture file for CmsContent tests.
 *
 * @package Cms.Fixture
 * @since 0.9b1
 */
class CmsContentFixture extends CakeTestFixture {
	public $name = 'CmsContent';
	public $table = 'cms_contents';

	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'primary', 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8),
		'views' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 9, 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified_by' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'category_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'length' => 6),
		'rating' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '3,2'),
		'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'comment_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'category_id' => array('column' => 'category_id', 'unique' => 0),
			'most_views' => array('column' => array('views', 'id'), 'unique' => 0),
			'active' => array('column' => array('active', 'ordering'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
		array(
			'id' => 'cms-content-1',
			'ordering' => 1,
			'views' => 30,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 0,
			'rating_count' => 0,
			'comment_count' => null
		),
		array(
			'id' => 'cms-content-2',
			'ordering' => 3,
			'views' => 89,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 4.5,
			'rating_count' => 2,
			'comment_count' => null
		),
		array(
			'id' => 'cms-content-3',
			'ordering' => 2,
			'views' => 3,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 0,
			'rating_count' => 0,
			'comment_count' => null
		),
	);
}