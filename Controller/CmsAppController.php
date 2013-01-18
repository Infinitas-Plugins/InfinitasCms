<?php
/**
 * CmsAppController
 *
 * @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
 * @link http://infinitas-cms.org
 * @package Cms.Controller
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.5a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.com>
 */

class CmsAppController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		// cake
		'Time', 'Html', 'Form',
		'Libs.Gravatar',
		// core
		'Cms.Cms'
	);
}