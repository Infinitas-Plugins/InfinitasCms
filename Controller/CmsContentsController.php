<?php
/**
 * CmsContentsController
 *
 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 * @link http://infinitas-cms.org
 * @package Cms.Controller
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5a
 *
 * @author Carl Sutton <dogmatic69@gmail.com>
 */

class CmsContentsController extends CmsAppController {

/**
 * frontend index action
 *
 * @return void
 */
	public function index() {
		$titleForLayout = null;
		$this->Paginator->settings = array(
			'conditions' => array(),
			'joins' => array()
		);
		$url = array();

		if (!empty($this->request->params['infinitas']['GlobalCategoryContent.slug'])) {
			$this->Paginator->settings['conditions']['GlobalCategoryContent.slug'] = $this->request->params['infinitas']['GlobalCategoryContent.slug'];
			$titleForLayout = __d('cms', 'Filed under :category');
			$url['category'] = $this->request->params['category'];
		}

		if (!empty($this->request->params['tag'])) {
			$titleForLayout = implode(' :: ', array($titleForLayout, $this->request->params['tag']));

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

		$contents = $this->Paginator->paginate();

		if (count($contents) == 1 && true){ //Configure::read('Cms.auto_redirect')) {
			$this->request->params['infintias']['CmsContent.id'] = $contents[0]['CmsContent']['id'];
			return $this->setAction('view');
		}

		$contents = $this->Paginator->paginate();
		if (!empty($this->request->params['category']) && count($contents)) {
			if (!empty($contents[0]['GlobalCategory']['meta_keywords'])) {
				$this->set('seoMetaKeywords', $contents[0]['GlobalCategory']['meta_keywords']);
			}

			if (!empty($contents[0]['GlobalCategory']['meta_description'])) {
				$this->set('seoMetaDescription', $contents[0]['GlobalCategory']['meta_description']);
			}
		}

		$this->set('contents', $contents);
		$this->set('seoCanonicalUrl', $url);
		$this->set('title_for_layout', $titleForLayout);
	}

/**
 * frontend view action
 *
 * @return void
 */
	public function view() {
		$id = !empty($this->request->params['infinitas'][$this->modelClass . '.id']) ? $this->request->params['infinitas'][$this->modelClass . '.id'] : null;
		if (!$id) {
			$this->notice('invalid');
			$this->redirect($this->referer());
		}

		$content = $this->CmsContent->getViewData(array(
			$this->modelClass . '.active' => 1,
			$this->modelClass . '.id' => $id
		));

		if (empty($content)) {
			return $this->notice(new NotFoundException());
		}

		$this->set('content', $content);

		$url = $this->Event->trigger('Cms.slugUrl', array('type' => 'contents', 'data' => $content));
		$this->set('seoCanonicalUrl', $url['slugUrl']['Cms']);
		$this->set('title_for_layout', $content['CmsContent']['title']);

		$this->set('seoMetaDescription', $content['CmsContent']['meta_description']);
		$this->set('seoMetaKeywords', $content['CmsContent']['meta_keywords']);
	}

/**
 * admin dashboard
 *
 * @return void
 */
	public function admin_dashboard() {
		$Content = ClassRegistry::init('Cms.CmsContent');

		$requireSetup = count($Content->GlobalContent->GlobalLayout->find('list')) >= 1;
		$this->set('requreSetup', $requireSetup);
		$this->set('hasContent', $Content->find('count') >= 1);
	}

/**
 * admin index
 *
 * @return void
 */
	public function admin_index() {
		$this->CmsContent->order = array_merge(
			array('GlobalCategoryContent.title'),
			$this->CmsContent->order
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
 * admin view
 *
 * @param string $id
 *
 * @return void
 */
	public function admin_view($id = null) {
		if (!$id) {
			$this->notice('invalid');
		}

		$this->set('content', $this->CmsContent->read(null, $id));
	}

/**
 * admin add
 *
 * Check there is layouts available before trying to add content
 *
 * @return void
 */
	public function admin_add() {
		if (!$this->CmsContent->hasLayouts()) {
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
		$contentTags = ClassRegistry::init('Contents.GlobalTag')->find('all');
		$this->set(compact('contentTags'));
	}

	public function admin_edit($id = null) {
		parent::admin_edit($id);

		$contentTags = ClassRegistry::init('Contents.GlobalTag')->find('all');
		$this->set(compact('contentTags'));
	}
}
