<?php
	/**
	* Cms content model
	*
	* The Content Model sets up relations for the content items.  Some of the
	* relations are users, configs and categories.  Many users can be related
	* to one content item as there is the person that last edited it, the person
	* busy editing (locker) and the creator.
	*
	* content is always sroted by the ordering field, but can be changed in the
	* backend by clicking one of the sortable links.
	*
	* Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	*
	* @filesource
	* @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	* @link http://infinitas-cms.org
	* @package cms
	* @subpackage cms.models.content
	* @license http://www.opensource.org/licenses/mit-license.php The MIT License
	* @since 0.5
	*
	* @author dogmatic69
	*
	* Licensed under The MIT License
	* Redistributions of files must retain the above copyright notice.
	*/

	class CmsContent extends CmsAppModel {
		public $lockable = true;

		public $contentable = true;

		public $_order = array(
			'CmsContent.ordering' => 'asc'
		);

		public $actsAs = array(
			'Cms.Cms'
		);

		public $hasOne = array(
			/* making duplicate records.
			'ContentConfig' => array(
				'className' => 'Cms.ContentConfig',
				'dependent' =>  true
			),*/
			'CmsFeature' => array(
				'className' => 'Cms.CmsFeature',
				'foreignKey' => 'content_id',
				'fields' => array(
					'CmsFeature.id'
				),
				'dependent' =>  true
			),
			'CmsFrontpage' => array(
				'className' => 'Cms.CmsFrontpage',
				'foreignKey' => 'content_id',
				'fields' => array(
					'CmsFrontpage.id'
				),
				'dependent' =>  true
			)
		);


		/**
		 * Construct for validation.
		 *
		 * This is used to make the validation messages run through __()
		 *
		 * @param mixed $id
		 * @param mixed $table
		 * @param mixed $ds
		 */
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'title' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter the title of your page')
					),
				),
				'category_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please select a category')
					)
				),
				'layout_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please select a layout')
					)
				),
				'group_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please select the group this content is for')
					)
				),
				'body' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter some text for the body')
					),
				),
			);
		}
		
		public function afterFind($results, $primary = false) {
			switch($this->findQueryType) {
				case 'first':
					$results = $this->attachComments($results);
					break;
			}
			
			return $results;
		}

		public function getViewData($conditions = null){
			if (!$conditions) {
				return array();
			}

			$content = $this->find(
				'first',
				array(
					'fields' => array(
						$this->alias . '.id',
						$this->alias . '.views',
						$this->alias . '.active',
						$this->alias . '.start',
						$this->alias . '.end',
						$this->alias . '.rating',
						$this->alias . '.rating_count',
					),
					'conditions' => $conditions
				)
			);

			return $content;
		}
	}