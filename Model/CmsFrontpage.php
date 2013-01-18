<?php
/**
 * CmsFrontpage
 *
 * This is items that will be show on the frontpage of the cms. It just stores
 * the fk of the content itme and the order it should be displayed in.
 *
 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 *
 * @link http://infinitas-cms.org
 * @package Cms.Model
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */

class CmsFrontpage extends CmsAppModel {

/**
 * direct delete or to trash
 *
 * @var boolean
 */
	public $noTrash = true;

/**
 * skip confirmation
 *
 * @var boolean
 */
	public $noConfirm = true;

/**
 * belongsTo relations
 *
 * @var array
 */
	public $belongsTo = array(
		'CmsContent' => array(
			'className' => 'Cms.CmsContent',
			'foreignKey' => 'content_id',
			'fields' => array(
				'CmsContent.id',
				'CmsContent.title',
				'CmsContent.slug',
				'CmsContent.body',
				'CmsContent.active',
				'CmsContent.comment_count',
				'CmsContent.created',
				'CmsContent.modified'
			)
		)
	);

/**
 * Constructor
 *
 * @param type $id
 * @param type $table
 * @param type $ds
 *
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->validate = array(
			'content_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'required' => true,
					'message' => __d('cms', 'Please select an item to be on the main cms page')
				)
			)
		);

		$this->order = array(
			$this->alias . '.order_id' => 'ASC',
			$this->alias . '.ordering' => 'ASC'
		);
	}
}