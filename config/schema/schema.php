<?php 
/* SVN FILE: $Id$ */
/* Cms schema generated on: 2010-11-11 17:11:52 : 1289495152*/
class CmsSchema extends CakeSchema {
	var $name = 'Cms';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $content_layouts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'content_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'css' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'html' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'php' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 9),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $contents = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'key' => 'index'),
		'views' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 9, 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'start' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'end' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'rating' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '3,2'),
		'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'layout_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'index'),
		'comment_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_access' => array('column' => 'group_id', 'unique' => 0), 'category_id' => array('column' => 'category_id', 'unique' => 0), 'most_views' => array('column' => array('views', 'id', 'title'), 'unique' => 0), 'active' => array('column' => array('active', 'ordering'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $features = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'content_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'order_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $frontpages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'content_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}
?>