<?php
/**
 * @brief fixture file for CmsFeature tests.
 *
 * @package Cms.Fixture
 * @since 0.9b1
 */
class CmsFeatureFixture extends CakeTestFixture {
	public $name = 'CmsFeature';
	public $table = 'cms_features';

	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'order_id' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 36),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
		array(
			'id' => 'cms-feature-1',
			'content_id' => 'cms-content-1',
			'ordering' => 1,
			'order_id' => 1,
			'created' => '2010-01-04 21:49:03'
		),
	);
}