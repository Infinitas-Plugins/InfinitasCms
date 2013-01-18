<?php
/**
 * CmsFrontpagesController
 *
 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 * @link http://infinitas-cms.org
 * @package Cms.Controller
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */

class CmsFrontpagesController extends CmsAppController {

/**
 * Frontend index action
 *
 * Shows only the items that are set as frontpage items. It will just
 * render the main content index view as its the same data.
 *
 * @return void
 */
	public function index() {
		$ids = $this->CmsFrontpage->find('list', array(
			'fields' => array(
				$this->modelClass . '.id',
				$this->modelClass . '.id'
			)
		));

		$contents = $this->CmsFrontpage->CmsContent->find('all', array(
			'conditions' => array(
				'CmsContent.id' => $ids
			),
			'order' => $this->CmsFrontpage->CmsContent->_order
		));

		$this->set('contents', $contents);
		$this->render('index', null, App::pluginPath('Cms') . 'views' . DS . 'contents' . DS . 'index.ctp');
	}

	public function admin_index() {
		$this->Paginator->settings = array(
			'conditions' => array(
				$this->modelClass . '.id IS NOT NULL'
			),
			'joins' => array(
				array(
					'table' => 'cms_frontpages',
					'alias' => 'CmsFrontpage',
					'type' => 'LEFT',
					'foreignKey' => false,
					'conditions' => array(
						'CmsFrontpage.content_id = CmsContent.id'
					)
				)
			)
		);

		$frontpages = $this->Paginator->paginate('CmsContent');

		$this->set(compact('frontpages'));
	}

	public function admin_add() {
		parent::admin_add();

		$conditions = array();
		$contentIds = $this->CmsFrontpage->find('list', array(
			'fields' => array(
				$this->modelClass . '.content_id',
				$this->modelClass . '.content_id'
			)
		));

		if ($contentIds) {
			$conditions['not']['CmsContent.id'] = array_values($contentIds);
		}

		$contents = $this->CmsFrontpage->CmsContent->find('list', array(
			'conditions' => $conditions
		));

		if (empty($contents)) {
			$this->notice(__d('cms', 'You have all the items on your home page.'), array(
				'level' => 'warning',
				'redirect' => true
			));
		}

		$this->set(compact('contents'));
	}
}