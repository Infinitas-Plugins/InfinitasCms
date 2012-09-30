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
/**
 * @brief frontend index action
 */
	public function index() {
		$titleForLayout = null;
		$this->Paginator->settings = array(
			'conditions' => array(),
			'joins' => array()
		);
		$url = array();

		if(!empty($this->request->params['category'])) {
			$this->Paginator->settings['conditions']['GlobalCategoryContent.slug'] = $this->request->params['category'];
			$titleForLayout = sprintf(__d('cms', 'Filed under %s'), $this->request->params['category']);
			$url['category'] = $this->request->params['category'];
		}

		if(!empty($this->request->params['tag'])) {
			$titleForLayout = sprintf(__d('cms', '%s :: %s'), $titleForLayout, $this->request->params['tag']);

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

		if(count($contents) == 1 && Configure::read('Cms.auto_redirect')) {
			$this->request->params['slug'] = $contents[0]['CmsContent']['slug'];
			$this->view();
		}

		$contents = $this->Paginator->paginate();
		if(!empty($this->request->params['category']) && count($contents)) {
			if(!empty($contents[0]['GlobalCategory']['meta_keywords'])) {
				$this->set('seoMetaKeywords', $contents[0]['GlobalCategory']['meta_keywords']);
			}

			if(!empty($contents[0]['GlobalCategory']['meta_description'])) {
				$this->set('seoMetaDescription', $contents[0]['GlobalCategory']['meta_description']);
			}
		}

		$this->set('contents', $contents);
		$this->set('seoCanonicalUrl', $url);
		$this->set('title_for_layout', $titleForLayout);
	}

/**
 * @brief frontend view action
 *
 * @throws NotFoundException
 */
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

		if(empty($content)) {
			throw new NotFoundException();
		}

		$this->set('content', $content);

		$url = $this->Event->trigger('Cms.slugUrl', array('type' => 'contents', 'data' => $content));
		$this->set('seoCanonicalUrl', $url['slugUrl']['Cms']);
		$this->set('title_for_layout', $content['CmsContent']['title']);

		$this->set('seoMetaDescription', $content['CmsContent']['meta_description']);
		$this->set('seoMetaKeywords', $content['CmsContent']['meta_keywords']);
	}

/**
 * @brief admin dashboard
 */
	public function admin_dashboard() {
		$Content = ClassRegistry::init('Cms.CmsContent');

		$requireSetup = count($Content->GlobalContent->GlobalLayout->find('list')) >= 1;
		$this->set('requreSetup', $requireSetup);
		$this->set('hasContent', $Content->find('count') >= 1);
	}

/**
 * @brief admin index
 */
	public function admin_index() {
		$this->CmsContent->order = array_merge(
			array('GlobalCategoryContent.title'),
			$this->CmsContent->_order
		);

		$contents = $this->Paginator->paginate(null, $this->Filter->filter);

		$filterOptions = $this->Filter->filterOptions;
		$filterOptions['fields'] = array(
			'title',
			'category_id' => array(null => __d('cms', 'All'), null => __d('cms', 'Top Level Categories')) + $this->CmsContent->GlobalContent->find('categoryList'),
			'group_id' => array(null => __d('cms', 'Public')) + $this->CmsContent->GlobalContent->Group->find('list'),
			'layout_id' => array(null => __d('cms', 'All')) + $this->CmsContent->GlobalContent->GlobalLayout->find('list'),
			'active' => (array)Configure::read('CORE.active_options')
		);

		$this->set(compact('contents','filterOptions'));
	}

/**
 * @brief admin view
 *
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$id) {
			$this->notice('invalid');
		}

		$this->set('content', $this->CmsContent->read(null, $id));
	}

/**
 * @brief admin add
 *
 * Check there is layouts available before trying to add content
 */
	public function admin_add() {
		if(!$this->CmsContent->hasLayouts()) {
			$this->notice(
				__d('cms', 'You need to create some layouts before you can create content'),
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
}
