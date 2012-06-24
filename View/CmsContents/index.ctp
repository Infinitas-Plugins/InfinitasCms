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

	if(empty($globalLayoutTemplate)) {
		throw new Exception('Template was not loaded, make sure one exists');
	}
	
    foreach($contents as $k => &$content) {
		$eventData = $this->Event->trigger('cmsBeforeContentRender', array('_this' => $this, 'content' => $content));
		$content['CmsContent']['events_before'] = '';
		foreach((array)$eventData['cmsBeforeContentRender'] as $_plugin => $_data) {
			$content['CmsContent']['events_before'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
		}

		$eventData = $this->Event->trigger('cmsAfterContentRender', array('_this' => $this, 'content' => $content));
		$content['CmsContent']['events_after'] = '';
		foreach((array)$eventData['cmsAfterContentRender'] as $_plugin => $_data) {
			$content['CmsContent']['events_after'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
		}

		$eventData = $this->Event->trigger('Cms.slugUrl', array('type' => 'contents', 'data' => $content));
		$url = InfinitasRouter::url(current($eventData['slugUrl']), true);
		$content['CmsContent']['title_link'] = $this->Html->link($content['CmsContent']['title'], $url);
		$content['CmsContent']['url'] = $url;

		$content['CmsContent']['created'] = CakeTime::format(Configure::read('Cms.time_format'), $content['CmsContent']['created']);
		$content['CmsContent']['modified'] = CakeTime::format(Configure::read('Cms.time_format'), $content['CmsContent']['modified']);

		$content['CmsContent']['module_comments'] = $this->ModuleLoader->loadDirect(
			'Comments.comment',
			array(
				'content' => $content,
				'modelName' => 'CmsContent',
				'foreign_id' => $content['CmsContent']['id']
			)
		);


		$content['CmsContent']['module_tags_list'] = $this->TagCloud->tagList($content, ',');
		$content['CmsContent']['module_tags'] = $this->ModuleLoader->loadDirect(
			'Cms.post_tag_cloud',
			array(
				'tags' => $content['GlobalTagged'],
				'title' => 'Tags'
			)
		);

		$content['CmsContent']['author_link'] = $this->GlobalContents->author($content);
		$content['CmsContent']['module_comment_count'] = sprintf(__d('comments', '%d Comments'), $content['CmsContent']['comment_count']);
    }
	
	if(count($contents) > 0) {
		$this->set('contents', $contents);
		$this->set('paginationNavigation', $this->element('pagination/navigation'));
	}
	
	echo $this->GlobalContents->renderTemplate($globalLayoutTemplate);