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

	class ContentsController extends CmsAppController {
		public $name = 'Contents';

		/**
		* Helpers.
		*
		* @access public
		* @var array
		*/
		public $helpers = array('Filter.Filter');

		public function beforeFilter(){
			parent::beforeFilter();
		}

		public function index() {
			if(isset($this->params['id'])){
				$ids = $this->Content->find(
					'list',
					array(
						'fields' => array(
							'Content.id', 'Content.id'
						),
						'conditions' => array(
							'Content.category_id' => $this->params['id']
						)
					)
				);

				$this->paginate = array(
					'conditions' => array(
						'Content.id' => $ids
					)
				);
			}

			$this->Content->order = $this->Content->_order;
			$contents = $this->paginate();

			if(count($contents) == 1 && Configure::read('Cms.auto_redirect')){
				$this->params['slug'] = $contents[0]['Content']['slug'];
				$this->view();
			}

			$this->set('contents', $this->paginate());
		}

		public function view() {
			if (!isset($this->params['slug'])) {
				$this->Session->setFlash( __('Invalid content selected', true) );
				$this->redirect($this->referer());
			}

			$content = $this->Content->getViewData(
				array(
					'Content.id' => $this->Content->getContentId($this->params['slug']),
					'Content.active' => 1
				)
			);

			$this->set('content', $content);
		}

		public function admin_index() {
			$this->Content->order = array_merge(
				array('GlobalCategoryContent.title'),
				$this->Content->_order
			);

			$contents = $this->paginate(null, $this->Filter->filter);

			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				'title',
				'category_id' => array(null => __('All', true), null => __('Top Level Categories', true)) + $this->Content->GlobalContent->find('categoryList'),
				'group_id' => array(null => __('Public', true)) + $this->Content->GlobalContent->Group->find('list'),
				'layout_id' => array(null => __('All', true)) + $this->Content->GlobalContent->GlobalLayout->find('list'),
				'active' => (array)Configure::read('CORE.active_options')
			);

			$this->set(compact('contents','filterOptions'));
		}

		public function admin_view($id = null) {
			if (!$id) {
				$this->Infinitas->noticeInvalidRecord();
			}
			
			$this->set('content', $this->Content->read(null, $id));
		}

		public function admin_add() {
			if(!$this->Content->hasLayouts()){
				$this->notice(
					__('You need to create some layouts before you can create content', true),
					array(
						'level' => 'warning',
						'redirect' => array(
							'controller' => 'global_layouts',
							'plugin' => 'contents',
							'action' => 'index'
						)
					)
				);
			}
			
			parent::admin_add();
		}

		public function admin_edit($id = null) {
			parent::admin_edit($id);
		}
	}
