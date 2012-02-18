<?php
	/**
	 * Frontpage model
	 *
	 * This is items that will be show on the frontpage of the cms. It just stores
	 * the fk of the content itme and the order it should be displayed in.
	 *
	 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 * @filesource
	 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 * @link http://infinitas-cms.org
	 * @package infinitas.cms
	 * @subpackage infinitas.cms.models.frontpage
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since 0.5a
	 */

	class CmsFrontpage extends CmsAppModel {
		/**
		 * direct delete or to trash
		 *
		 * @access public
		 * @var bool
		 */
		public $noTrash = true;

		/**
		 * skip confirmation
		 *
		 * @access public
		 * @var bool
		 */
		public $noConfirm = true;

		/**
		 * Default ordering for index pages
		 *
		 * @access public
		 * @var array
		 */
		public $order = array();

		/**
		 * belongsTo relations
		 *
		 * @access public
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

		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'content_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please select an item to be on the main cms page')
					)
				)
			);

			$this->order = array(
				$this->alias . '.order_id' => 'ASC',
				$this->alias . '.ordering' => 'ASC'
			);
		}
	}