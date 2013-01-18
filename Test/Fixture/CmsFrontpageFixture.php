<?php
/**
 * @brief fixture file for CmsFrontpage tests.
 *
 * @package Cms.Fixture
 * @since 0.9b1
 */

class CmsFrontpageFixture extends CakeTestFixture {

	public $name = 'CmsFrontpage';

	public $table = 'cms_frontpages';

	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'key' => 'primary', 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5),
		'order_id' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 36, 'length' => 3),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
		array(
			'id' => 'cms-frontpage-1',
			'content_id' => 'cms-content-2',
			'ordering' => 1,
			'order_id' => 1,
			'created' => '2010-01-01 00:00:00'
		),
	);
}