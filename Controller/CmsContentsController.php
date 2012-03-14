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
			$titleForLayout = null;
			$this->Paginator->settings = array(
				'conditions' => array(),
				'joins' => array()
			);
			$url = array();
			
			if(!empty($this->request->params['category'])) {
				$this->Paginator->settings['conditions']['GlobalCategoryContent.slug'] = $this->request->params['category'];
				$titleForLayout = sprintf(__d('cms', 'Content filed under %s'), $this->request->params['category']);
				$url['category'] = $this->request->params['category'];
			}
			
			if(!empty($this->request->params['tag'])) {
				$titleForLayout = sprintf(__d('blog', '%s related to %s'), $titleForLayout, $this->request->params['tag']);
				
				$this->Paginator->settings['joins'][] = array(
					'table' => 'global_tagged',
					'alias' => 'GlobalTagged',
					'type' => 'LEFT',
					'conditions' => array(
						'GlobalTagged.foreign_key = GlobalContent.id'
					)
				);
				$this->Paginator->settings['joins'][] = array(
					'table' => 'global_tags',
					'alias' => 'GlobalTag',
					'type' => 'LEFT',
					'conditions' => array(
						'GlobalTag.id = GlobalTagged.tag_id'
					)
				);
				
				$this->Paginator->settings['conditions']['GlobalTag.keyname'] = $this->request->params['tag'];
				$url['tag'] = $this->request->params['tag'];
			}

			$this->CmsContent->order = $this->CmsContent->_order;
			$contents = $this->Paginator->paginate();

			if(count($contents) == 1 && Configure::read('Cms.auto_redirect')){
				$this->request->params['slug'] = $contents[0]['CmsContent']['slug'];
				$this->view();
			}

			$this->set('contents', $this->Paginator->paginate());
			$this->set('seoContentIndex', Configure::read('Blog.robots.index.index'));
			$this->set('seoContentFollow', Configure::read('Blog.robots.index.follow'));
			$this->set('seoCanonicalUrl', $url);
			$this->set('title_for_layout', $titleForLayout);
		}

		public function view() {
			if (!isset($this->request->params['slug'])) {
				$this->notice('invalid');
				$this->redirect($this->referer());
			}

			$content = $this->CmsContent->getViewData(
				array(
					'GlobalContent.slug' => $this->request->params['slug'],
					$this->modelClass . '.active' => 1
				)
			);

			$this->set('content', $content);
			
			$url = $this->Event->trigger('Cms.slugUrl', array('type' => 'contents', 'data' => $content));
			$this->set('seoCanonicalUrl', current($url['slugUrl']));
			$this->set('seoContentIndex', Configure::read('Cms.robots.index.index'));
			$this->set('seoContentFollow', Configure::read('Cms.robots.index.follow'));
			$this->set('title_for_layout', $content['CmsContent']['title']);
			Configure::write('Website.keywords', $content['CmsContent']['meta_keywords']);
			Configure::write('Website.description', $content['CmsContent']['meta_description']);
		}

		public function admin_index() {
			$this->CmsContent->order = array_merge(
				array('GlobalCategoryContent.title'),
				$this->CmsContent->_order
			);

			$contents = $this->Paginator->paginate(null, $this->Filter->filter);

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
