<?php
class R4ce00aa475bc4c48a24f120b6318cd70 extends CakeRelease {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = 'Migration for Cms version 0.1';

/**
 * Plugin name
 *
 * @var string
 * @access public
 */
	public $plugin = 'Cms';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'contents' => array(
					'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8),
					'views' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 9, 'key' => 'index'),
					'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
					'start' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'end' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'rating' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '3,2'),
					'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
					'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'modified_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'index'),
					'comment_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'category_id' => array('column' => 'category_id', 'unique' => 0),
						'most_views' => array('column' => array('views', 'id'), 'unique' => 0),
						'active' => array('column' => array('active', 'ordering'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'features' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'content_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'ordering' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
					'order_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'frontpages' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'content_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5),
					'order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'contents', 'features', 'frontpages'
			),
		),
	);

	
/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
?>