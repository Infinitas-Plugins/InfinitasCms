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
			$ids = $this->Frontpage->find(
				'list',
				array(
					'fields' => array(
						'Frontpage.id',
						'Frontpage.id'
					)
				)
			);

			$contents = $this->Frontpage->Content->find(
				'all',
				array(
					'conditions' => array(
						'Content.id' => $ids
					),
					'contain' => array(
						'GlobalCategory',
						'ContentComment'
					),
					'order' => $this->Frontpage->Content->_order
				)
			);

			$this->set('contents', $contents);
			$this->render('index', null, App::pluginPath('Cms') . 'views' . DS . 'contents' . DS . 'index.ctp');
		}

		public function admin_index() {
			$this->paginate = array(
				'conditions' => array(
					'Frontpage.id IS NOT NULL'
				)
			);

			$frontpages = $this->paginate('Content');

			$this->set(compact('frontpages'));
		}

		public function admin_add() {
			parent::admin_add();

			/**
			* check what is already in the table so that the list only shows
			* what is available.
			*/
			$content_ids = $this->Frontpage->find(
				'list',
				array(
					'fields' => array(
						'Frontpage.content_id',
						'Frontpage.content_id'
					)
				)
			);

			$conditions = array();
			if($content_ids) {
				$conditions = array(
					'not' => array(
						'Content.id ' => $content_ids
					)
				);
			}

			/**
			* only get the content itmes that are not being used.
			*/
			$contents = $this->Frontpage->Content->find('list', array('conditions' => $conditions));

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