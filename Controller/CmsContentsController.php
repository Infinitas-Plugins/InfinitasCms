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

	class CmsContentsController extends CmsAppController {
		public function index() {
			if(isset($this->request->params['id'])){
				$ids = $this->CmsContent->find(
					'list',
					array(
						'fields' => array(
							$this->modelClass . '.id', 'Content.id'
						),
						'conditions' => array(
							$this->modelClass . '.category_id' => $this->request->params['id']
						)
					)
				);

				$this->paginate = array(
					'conditions' => array(
						$this->modelClass . '.id' => $ids
					)
				);
			}

			$this->CmsContent->order = $this->CmsContent->_order;
			$contents = $this->paginate();

			if(count($contents) == 1 && Configure::read('Cms.auto_redirect')){
				$this->request->params['slug'] = $contents[0]['CmsContent']['slug'];
				$this->view();
			}

			$this->set('contents', $this->paginate());
		}

		public function view() {
			if (!isset($this->request->params['slug'])) {
				$this->notice('invalid');
				$this->redirect($this->referer());
			}

			$content = $this->CmsContent->getViewData(
				array(
					//$this->modelClass . '.id' => $this->CmsContent->getContentId($this->request->params['slug']),
					$this->modelClass . '.active' => 1
				)
			);

			$this->set('content', $content);
		}

		public function admin_index() {
			$this->CmsContent->order = array_merge(
				array('GlobalCategoryContent.title'),
				$this->CmsContent->_order
			);

			$contents = $this->paginate(null, $this->Filter->filter);

			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				'title',
				'category_id' => array(null => __('All'), null => __('Top Level Categories')) + $this->CmsContent->GlobalContent->find('categoryList'),
				'group_id' => array(null => __('Public')) + $this->CmsContent->GlobalContent->Group->find('list'),
				'layout_id' => array(null => __('All')) + $this->CmsContent->GlobalContent->GlobalLayout->find('list'),
				'active' => (array)Configure::read('CORE.active_options')
			);

			$this->set(compact('contents','filterOptions'));
		}

		public function admin_view($id = null) {
			if (!$id) {
				$this->notice('invalid');
			}
			
			$this->set('content', $this->CmsContent->read(null, $id));
		}

		public function admin_add() {
			if(!$this->CmsContent->hasLayouts()){
				$this->notice(
					__('You need to create some layouts before you can create content'),
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
