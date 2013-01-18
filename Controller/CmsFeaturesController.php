<?php
/**
 * CmsFeaturesController
 *
 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 * @link http://infinitas-cms.org
 * @package Cms.Controller
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */

class CmsFeaturesController extends CmsAppController {

	public function index() {
		$this->CmsFeature->recursive = 0;
		$this->set('features', $this->paginate);
	}

	public function admin_index() {
		$this->Paginator->settings = array(
			'conditions' => array(
				$this->modelClass . '.id IS NOT NULL'
			),
			'joins' => array(
				array(
					'table' => 'cms_features',
					'alias' => 'CmsFeature',
					'type' => 'LEFT',
					'foreignKey' => false,
					'conditions' => array(
						'CmsFeature.content_id = CmsContent.id'
					)
				)
			)
		);

		$features = $this->Paginator->paginate('CmsContent');
		$this->set(compact('features'));
	}

/**
 * Create new featured items
 *
 * You can only add ones that dont exist, no point having 2 of the same,
 * If there is no more, it will just redirect back to where you were.
 *
 * @return void
 */
	public function admin_add() {
		parent::admin_add();

		$contentIds = $this->CmsFeature->find('list', array(
			'fields' => array(
				$this->modelClass . '.content_id',
				$this->modelClass . '.content_id'
			)
		));

		$conditions = array();
		if ($contentIds) {
			$conditions['not']['CmsContent.id'] = array_values($contentIds);
		}

		$contents = $this->CmsFeature->CmsContent->find('list', array('conditions' => $conditions));

		if (empty($contents)) {
			$this->notice(__d('cms', 'You have already made all the content items featured.'), array(
				'level' => 'warning',
				'redirect' => true
			));
		}

		$this->set(compact('contents'));
	}
}