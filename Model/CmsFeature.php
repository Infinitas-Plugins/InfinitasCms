<?php
/**
 * CmsFeature
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

class CmsFeature extends CmsAppModel {

/**
 * BelongsTo relation
 *
 * @var array
 */
	public $belongsTo = array(
		'CmsContent' => array(
			'className' => 'Cms.CmsContent',
			'foreignKey' => 'content_id',
			'fields' => array(
				'CmsContent.id',
				'CmsContent.active',
				'CmsContent.category_id',
			)
		)
	);

/**
 * dont send things to trash
 * @var boolean
 */
	public $noTrash = true;

/**
 * dont ask to confirm deletes
 *
 * @var boolean
 */
	public $noConfirm = true;

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
					'message' => __d('cms', 'Please select the content item that should be featured')
				)
			)
		);

		$this->order = array(
			$this->alias . '.ordering' => 'ASC'
		);
	}
}