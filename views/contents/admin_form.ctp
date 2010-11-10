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
		echo $this->Infinitas->adminEditHead();?>
		<fieldset>
			<h1><?php echo __('Content', true); ?></h1><?php
			echo $this->Form->input('id');
			echo $this->Form->input('title', array('class' => 'title'));
			echo $this->element('category_list', array('plugin' => 'Categories'));
			echo $this->Cms->wysiwyg('Content.body'); ?>
		</fieldset>
		<fieldset>
			<h1><?php echo __('Config', true); ?></h1><?php
			echo $this->Form->input('active');
			echo $this->Form->input('layout_id');
			echo $this->Form->input('group_id', array('label' => __('Min Group', true)));
			echo $this->Form->hidden('ContentConfig.id');?>
		</fieldset>
		<fieldset>
			<h1><?php echo __('Author', true); ?></h1><?php
			echo $this->Form->input('ContentConfig.author_alias');
			echo $this->Form->input('ContentConfig.keywords');
			echo $this->Form->input('ContentConfig.description', array('class'=>'title')); ?>
		</fieldset><?php
	echo $this->Form->end();