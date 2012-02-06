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

	class FrontpagesController extends CmsAppController {
		public $name = 'Frontpages';

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
				'fields' => array(
					'Frontpage.id',
					'Frontpage.content_id',
					'Frontpage.ordering',
					'Frontpage.created',
					'Frontpage.modified'
				),
				'contain' => array(
					'Content' => array(
						// default has more items
						'fields' => array(
							'Content.id',
							'Content.active',
						),
						'GlobalContent',
						'GlobalCategory'
					)
				)
			);

			$frontpages = $this->paginate();
			foreach($frontpages as $k => $frontpage){
				$frontpages[$k]['Content'] += $frontpage['Content']['GlobalContent'];
			}

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

			/**
			* only get the content itmes that are not being used.
			*/
			$contents = $this->Frontpage->Content->find(
				'list',
				array(
					'conditions' => array(
						'Content.id NOT IN ( ' . implode(',', ((!empty($content_ids)) ? $content_ids : array(0))) . ' )'
					)
				)
			);

			if (empty($contents)) {
				$this->notice(
					__('You have all the items on your home page.', true),
					array(
						'level' => 'warning',
						'redirect' => true
					)
				);
			}

			$this->set(compact('contents'));
		}
	}