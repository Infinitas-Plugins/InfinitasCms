<?php
	/**
	*/
	class FeaturesController extends CmsAppController {
		public $name = 'Features';

		public function index() {
			$this->Feature->recursive = 0;
			$this->set('features', $this->paginate);
		}

		public function admin_index() {
			$this->paginate = array(
				'conditions' => array(
					'Feature.id IS NOT NULL'
				)
			);

			$features = $this->paginate('Content');
			$this->set(compact('features'));
		}

		/**
		 * Create new featured items
		 *
		 * You can only add ones that dont exist, no point having 2 of the same,
		 * If there is no more, it will just redirect back to where you were.
		 */
		public function admin_add() {
			parent::admin_add();

			$content_ids = $this->Feature->find(
				'list',
				array(
					'fields' => array(
						'Feature.content_id',
						'Feature.content_id'
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

			$contents = $this->Feature->Content->find('list', array('conditions' => $conditions));

			if (empty($contents)) {
				$this->notice(
					__('You have already made all the content items featured.', true),
					array(
						'level' => 'warning',
						'redirect' => true
					)
				);
			}

			$this->set(compact('contents'));
		}
	}