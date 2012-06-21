<?php
	/**
	 * Comment Template.
	 *
	 * @todo Implement .this needs to be sorted out.
	 *
	 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 * @filesource
	 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 * @link http://infinitas-cms.org
	 * @package sort
	 * @subpackage sort.comments
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since 0.5a
	 */

	class CmsFeature extends CmsAppModel {
		public $order = array();

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
		 * @var bool
		 */
		public $noTrash = true;

		/**
		 * dont ask to confirm deletes
		 * @var bool
		 */
		public $noConfirm = true;

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