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
		* Helpers.
		*
		* @access public
		* @var array
		*/
		public $helpers = array('Filter.Filter');

		public function index() {
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
						'Author',
						'Editor',
						'Category',
						'Feature',
						'ContentComment'
					)
				)
			);

			$frontpages = $this->paginate();

			$this->set('frontpages', $frontpages);
			$this->set('filterOptions', $this->Filter->filterOptions);
		}

		public function admin_index() {
			$this->Frontpage->recursive = 0;

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
						'fields' => array(
							'Content.id',
							'Content.title',
							'Content.active',
						),
						'Category'
					)
				)
			);

			$frontpages = $this->paginate();


			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				//@todo get related filter working
			);

			$this->set('frontpages', $frontpages);
			$this->set('filterOptions', $filterOptions);
		}

		public function admin_add() {
			if (!empty($this->data)) {
				$this->Frontpage->create();
				if ($this->Frontpage->save($this->data)) {
					$this->Session->setFlash(__('The frontpage has been saved', true));
					$this->redirect(array('action' => 'index'));
				}else {
					$this->Session->setFlash(__('The frontpage could not be saved. Please, try again.', true));
				}
			}

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
				$this->Session->setFlash(__('You have all the items on your home page.', true));
				$this->redirect($this->referer());
			}

			$this->set(compact('contents'));
		}
	}