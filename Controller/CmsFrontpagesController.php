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

	class CmsFrontpagesController extends CmsAppController {
		/**
		 * Shows only the items that are set as frontpage items. It will just
		 * render the main content index view as its the same data.
		 */
		public function index() {
			$ids = $this->CmsFrontpage->find(
				'list',
				array(
					'fields' => array(
						$this->modelClass . '.id',
						$this->modelClass . '.id'
					)
				)
			);

			$contents = $this->CmsFrontpage->CmsContent->find(
				'all',
				array(
					'conditions' => array(
						'CmsContent.id' => $ids
					),
					'order' => $this->CmsFrontpage->CmsContent->_order
				)
			);

			$this->set('contents', $contents);
			$this->render('index', null, App::pluginPath('Cms') . 'views' . DS . 'contents' . DS . 'index.ctp');
		}

		public function admin_index() {
			$this->paginate = array(
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

			$frontpages = $this->paginate('CmsContent');

			$this->set(compact('frontpages'));
		}

		public function admin_add() {
			parent::admin_add();

			/**
			* check what is already in the table so that the list only shows
			* what is available.
			*/
			$content_ids = $this->CmsFrontpage->find(
				'list',
				array(
					'fields' => array(
						$this->modelClass . '.content_id',
						$this->modelClass . '.content_id'
					)
				)
			);

			$conditions = array();
			if($content_ids) {
				$conditions = array(
					'not' => array(
						'CmsContent.id ' => $content_ids
					)
				);
			}

			/**
			* only get the content itmes that are not being used.
			*/
			$contents = $this->CmsFrontpage->CmsContent->find('list', array('conditions' => $conditions));

			if (empty($contents)) {
				$this->notice(
					__('You have all the items on your home page.'),
					array(
						'level' => 'warning',
						'redirect' => true
					)
				);
			}

			$this->set(compact('contents'));
		}
	}