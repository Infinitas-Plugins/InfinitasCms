<?php
class CmsBehavior extends ModelBehavior {

	public function beforeFind(Model $Model, $query) {
		if (empty($query['fields'])) {
			$query['fields'] = array($Model->alias . '.*');
		}
		if (!is_array($query['fields'])) {
			$query['fields'] = array($query['fields']);
		}

		switch ($Model->name) {
			case 'CmsContent':
				$query = $this->_contentBeforeFind($Model, $query);
				break;
		}

		return $query;
	}

	protected function _contentBeforeFind(Model $Model, $query) {
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

		$query['fields'] = array_merge((array)$query['fields'], array(
			'Feature.*',
			'Frontpage.*',
		));

		return $query;
	}
}