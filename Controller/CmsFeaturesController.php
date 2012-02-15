<?php
	/**
	*/
	class CmsFeaturesController extends CmsAppController {
		public function index() {
			$this->CmsFeature->recursive = 0;
			$this->set('features', $this->paginate);
		}

		public function admin_index() {
			$this->paginate = array(
				'conditions' => array(
					$this->modelClass . '.id IS NOT NULL'
				)
			);

			$features = $this->paginate('CmsContent');
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

			$content_ids = $this->CmsFeature->find(
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

			$contents = $this->CmsFeature->CmsContent->find('list', array('conditions' => $conditions));

			if (empty($contents)) {
				$this->notice(
					__('You have already made all the content items featured.'),
					array(
						'level' => 'warning',
						'redirect' => true
					)
				);
			}

			$this->set(compact('contents'));
		}
	}