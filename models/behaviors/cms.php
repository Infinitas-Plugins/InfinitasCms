<?php
	class CmsBehavior extends ModelBehavior {
		public function beforeFind($Model, $query) {
			if($Model->findQueryType == 'count'){
				return $query;
			}

			if(empty($query['fields'])) {
				$query['fields'] = array($Model->alias . '.*');
			}
			if(!is_array($query['fields'])) {
				$query['fields'] = array($query['fields']);
			}
			
			switch($Model->name) {
				case 'Content':
					$query = $this->__contentBeforeFind($Model, $query);
					break;
			}
			
			return $query;
		}

		private function __contentBeforeFind($Model, $query) {
			$query['joins'][] = array(
				'table' => 'cms_features',
				'alias' => 'Feature',
				'type' => 'LEFT',
				'conditions' => array(
					'Feature.content_id = ' . $Model->alias . '.' . $Model->primaryKey,
				)
			);

			$query['joins'][] = array(
				'table' => 'cms_frontpages',
				'alias' => 'Frontpage',
				'type' => 'LEFT',
				'conditions' => array(
					'Frontpage.content_id = ' . $Model->alias . '.' . $Model->primaryKey,
				)
			);
			
			$query['fields'] = array_merge(
				$query['fields'],
				array(
					'Feature.*',
					'Frontpage.*',
				)
			);
			
			return $query;
		}
	}