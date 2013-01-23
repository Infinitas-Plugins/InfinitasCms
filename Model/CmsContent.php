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
 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
 * @link http://infinitas-cms.org
 * @package cms
 * @subpackage cms.models.content
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */

class CmsContent extends CmsAppModel {

/**
 * Lock rows when editing
 *
 * @var boolean
 */
	public $lockable = true;

/**
 * Use the contents plugin
 *
 * @var boolean
 */
	public $contentable = true;

	public $actsAs = array(
		'Cms.Cms'
	);

/**
 * Custom find methods
 *
 * @var array
 */
	public $findMethods = array(
		'latest' => true,
		'routingInfo' => true
	);

/**
 * HasOne relations
 *
 * @var array
 */
	public $hasOne = array(
		'CmsFeature' => array(
			'className' => 'Cms.CmsFeature',
			'foreignKey' => 'content_id',
			'fields' => array(
				'CmsFeature.id'
			),
			'dependent' => true
		),
		'CmsFrontpage' => array(
			'className' => 'Cms.CmsFrontpage',
			'foreignKey' => 'content_id',
			'fields' => array(
				'CmsFrontpage.id'
			),
			'dependent' => true
		)
	);

/**
 * Constructor
 *
 * @param mixed $id
 * @param mixed $table
 * @param mixed $ds
 *
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->order = array(
			$this->alias . '.ordering' => 'asc'
		);

		$this->validate = array(
			'title' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('cms', 'Please enter the title of your page')
				),
			),
			'category_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('cms', 'Please select a category')
				)
			),
			'layout_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('cms', 'Please select a layout')
				)
			),
			'group_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('cms', 'Please select the group this content is for')
				)
			),
			'body' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('cms', 'Please enter some text for the body')
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

	public function getViewData($conditions = null) {
		if (!$conditions) {
			return array();
		}

		$content = $this->find('first', array(
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
		));

		return $content;
	}

	protected function _findRoutingInfo($state, array $query, array $results = array()) {
		if ($state == 'before') {
			$request = array_merge(array(
				'category' => null,
				'slug' => null,
				'tag' => null,
				'pass' => array()
			), $query['request']);
			unset($query['request']);

			$conditions = array();
			if ($request['category']) {
				$conditions['GlobalCategoryContent.slug'] = $request['category'];
			}
			if ($request['slug']) {
				$conditions[$this->GlobalContent->fullFieldName('slug')] = $request['slug'];
			}
			if ($request['pass']) {
				$id = $this->field('id', array(
					$this->alias . '.' . $this->primaryKey => $request['pass']
				));
				if ($id) {
					$conditions['or'] = array(
						$this->alias . '.' . $this->primaryKey => $id
					);
				}
			}
			if ($request['tag']) {
				//$conditions[$this->GlobalContent->GlobalTaggged->fullFieldName('keyname')] = $request['tag'];
			}

			if (empty($conditions)) {
				throw new InvalidArgumentException(__d('cms', 'unable to find the content'));
			}
			$query['conditions'] = $conditions;

			$query['limit'] = 1;

			return $query;
		}
		
		if (empty($results)) {
			return false;
		}
		$results = $results[0];

		return array(
			$this->alias . '.' . $this->primaryKey => $results[$this->alias][$this->primaryKey],
			$this->alias . '.slug' => $results[$this->alias]['slug'],
			'GlobalCategoryContent.slug' => $results['GlobalCategoryContent']['slug'],
		);
	}

/**
 * @brief get the latest content (by category if required)
 *
 * @code
 *	$this->CmsContents->find('latest'); // latest row
 *	$this->CmsContents->find('latest', 'my-category'); // latest row in the 'my-category' section
 * @nocode
 *
 * @see Model::find() for custom cakephp finds
 *
 * @param type $state
 * @param type $query
 * @param type $results
 *
 * @return array
 */
	protected function _findLatest($state, $query, $results = array()) {
		if ($state === 'before') {
			if (!empty($query[0])) {
				$query['conditions']['GlobalCategoryContent.slug'] = $query[0];
			}

			$query['order'] = array(
				'GlobalContent.created' => 'desc'
			);
			$query['limit'] = 1;

			return $query;
		}

		return current($results);
	}
}