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
				'fields' => array(
					'Feature.id',
					'Feature.content_id',
					'Feature.ordering',
					'Feature.created'
				),
				'contain' => array(
					'Content' => array(						
						'GlobalCategory',
						'GlobalContent'
					)
				)
			);

			$features = $this->paginate();

			foreach($features as $k => $feature){
				$features[$k]['Content'] += $feature['Content']['GlobalContent'];
			}

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

			/**
			 * check what is already in the table so that the list only shows
			 * what is available.
			 */
			$content_ids = $this->Feature->find(
				'list',
				array(
					'fields' => array(
						'Feature.content_id',
						'Feature.content_id'
					)
				)
			);

			/**
			 * only get the content itmes that are not being used.
			 */
			$contents = $this->Feature->Content->find(
				'list',
				array(
					'conditions' => array(
						'Content.id NOT IN ( ' . implode(',', ((!empty($content_ids)) ? $content_ids : array(0))) . ' )'
					)
				)
			);

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