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

	class Content extends CmsAppModel {
		public $name = 'Content';

		public $_order = array(
			'Category.title' => 'asc',
			'Content.ordering' => 'asc'
		);

		public $belongsTo = array(
			'Author' => array(
				'className' => 'Management.User',
				'foreignKey' => 'created_by',
				'fields' => array(
					'Author.id',
					'Author.username'
				)
			),
			'Editor' => array(
				'className' => 'Management.User',
				'foreignKey' => 'modified_by',
				'fields' => array(
					'Editor.id',
					'Editor.username'
				)
			),
			'Group' => array(
				'className' => 'Management.Group',
				'fields' => array(
					'Group.id',
					'Group.name'
				)
			),
			'Locker' => array(
				'className' => 'Management.User',
				'foreignKey' => 'locked_by',
				'fields' => array(
					'Locker.id',
					'Locker.username'
				)
			),
			'Layout' => array(
				'className' => 'Cms.ContentLayout',
				'foreignKey' => 'layout_id',
				'counterCache' => true
			)
		);

		public $hasOne = array(
			/* making duplicate records.
			'ContentConfig' => array(
				'className' => 'Cms.ContentConfig',
				'dependent' =>  true
			),*/
			'Feature' => array(
				'className' => 'Cms.Feature',
				'fields' => array(
					'Feature.id'
				),
				'dependent' =>  true
			),
			'Frontpage' => array(
				'className' => 'Cms.Frontpage',
				'fields' => array(
					'Frontpage.id'
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
						'message' => __('Please enter the title of your page', true)
					),
				),
				'category_id' => array(
					'rule' => array('comparison', '>=', 1),
					'message' => __('Please select a category', true)
				),
				'body' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter some text for the body', true)
					),
				),
			);
		}

		public function getContentPage($slug = null){
			if (!$slug) {
				return array();
			}

			$content = $this->find(
				'first',
				array(
					'fields' => array(
						'Content.id',
						'Content.title',
						'Content.slug',
						'Content.body',
						'Content.group_id',
						'Content.views',
						'Content.active',
						'Content.start',
						'Content.end',
						'Content.created',
						'Content.modified',
						'Content.layout_id',
						'Content.rating',
						'Content.rating_count',
					),
					'conditions' => array(
						'Content.slug' => $slug,
						'Content.active' => 1
					),
					'contain' => array(
						'Layout' => array(
							'fields' => array(
								'Layout.id',
								'Layout.html',
								'Layout.css',
								'Layout.id',
							)
						),
						'Category' => array(
							'fields' => array(
								'Category.id',
								'Category.title',
								'Category.slug',
							)
						)
					)
				)
			);

			return $content;
		}

		public function getPopular($limit = 10){
			return $this->find(
				'all',
				array(
					'fields' => array(
						'Content.id',
						'Content.title',
						'Content.slug',
						'Content.category_id'
					),
					'conditions' => array(
						'Content.active' => 1
					),
					'contain' => array(
						'Category' => array(
							'fields' => array(
								'Category.slug'
							)
						)
					),
					'limit' => (int)$limit,
					'order' => array(
						'Content.views' => 'desc'
					)
				)
			);
		}

		public function getMostCommented($limit = 10){
			return $this->find(
				'all',
				array(
					'fields' => array(
						'Content.id',
						'Content.title',
						'Content.slug',
						'Content.category_id'
					),
					'conditions' => array(
						'Content.active' => 1
					),
					'contain' => array(
						'Category' => array(
							'fields' => array(
								'Category.slug'
							)
						)
					),
					'limit' => (int)$limit,
					'order' => array(
						'Content.comment_count' => 'desc'
					)
				)
			);
		}

		public function getRelated(){
			return array();
		}
	}