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
	echo $this->Form->create('Content', array('inputDefaults' => array('empty' => Configure::read('Website.empty_select'))));
		echo $this->Infinitas->adminEditHead();
		echo $this->element('content_form', array('plugin' => 'Contents')); ?>
		<fieldset>
			<h1><?php echo __('Other Info', true); ?></h1><?php
			echo $this->Form->input('id');
			echo $this->Form->input('active');
			echo $this->Form->hidden('ContentConfig.id');
			echo $this->Form->input('ContentConfig.author_alias'); ?>
		</fieldset><?php
	echo $this->Form->end();