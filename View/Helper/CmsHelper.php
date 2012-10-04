<?php
/**
 * Cms helper
 *
 *
 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 * @link          http://infinitas-cms.org
 * @package       sort
 * @subpackage    sort.comments
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since         0.5a
 */

class CmsHelper extends AppHelper {
	public $helpers = array(
		//cake
		'Html', 'Form',

		// core helpers
		'Libs.Wysiwyg',
		'Libs.Design',
		'Libs.Image'
	);

	/**
		* generate icons for homepage items.
		*
		* @param array $record the row to check
		* @param string $model the current model
		* @return string some html for an icon
		*/
	public function homePageItem($record = array(), $model = 'Frontpage') {
		if (empty($record)) {
			$this->errors[] = 'cant check nothing.';
			return false;
		}

		$record = array_filter($record[$model]);

		if (!empty($record)) {
			return $this->Image->image(
				'status',
				'home',
				array(
					'alt'   => __d('cms', 'Yes'),
					'title' => __d('cms', 'Home page item'),
					'width' => '16px'
				)
			);
		}

		return $this->Image->image(
			'status',
			'not-home',
			array(
				'alt'   => __d('cms', 'No'),
				'title' => __d('cms', 'Not on home page'),
				'width' => '16px'
			)
		);
	}

/**
 * Featured icon.
 *
 * Creates a featured icon like the status and locked.
 *
 * @param array $record the data from find
 * @param string $model the model alias
 *
 * @return string html of the icon.
 */
	public function featuredItem($record = array(), $model = 'Feature') {
		$record = array_filter($record[$model]);
		if (empty($record)) {
			return $this->Image->image(
				'status',
				'not-featured',
				array(
					'alt'   => __d('cms', 'No'),
					'title' => __d('cms', 'Not a featured item'),
					'width' => '16px'
				)
			);
		}

		return $this->Image->image(
			'status',
			'featured',
			array(
				'alt'   => __d('cms', 'Yes'),
				'title' => __d('cms', 'Featured Item'),
				'width' => '16px'
			)
		);
	}
}