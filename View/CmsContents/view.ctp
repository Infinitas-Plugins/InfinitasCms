<?php
	/**
	 * Comment Template.
	 *
	 * @todo -c Implement .this needs to be sorted out.
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
if(empty($content)) {
	$content = $cmsContent;
}

	$eventData = $this->Event->trigger('cmsBeforeContentRender', array('_this' => $this, 'content' => $content));
	foreach((array)$eventData['cmsBeforeContentRender'] as $_plugin => $_data){
		echo '<div class="before '.$_plugin.'">'.$_data.'</div>';
	}
	
	$content['CmsContent']['created'] = CakeTime::format(Configure::read('Cms.time_format'), $content['CmsContent']['created']);
	$content['CmsContent']['modified'] = CakeTime::format(Configure::read('Cms.time_format'), $content['CmsContent']['modified']);

	$content['CmsContent']['author'] = $this->GlobalContents->author($content);

	// need to overwrite the stuff in the viewVars for mustache 
	$this->set('content', $content);

	if(!empty($content['Layout']['css'])){
		?><style type="text/css"><?php echo $content['Layout']['css']; ?></style><?php
	}

	// render the content template
	echo $content['Layout']['html'];

	
	$eventData = $this->Event->trigger('cmsAfterContentRender', array('_this' => $this, 'content' => $content));
	foreach((array)$eventData['cmsAfterContentRender'] as $_plugin => $_data){
		echo '<div class="after '.$_plugin.'">'.$_data.'</div>';
	}