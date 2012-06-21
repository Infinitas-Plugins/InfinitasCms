<?php
	if (!empty($categories) && !empty($layouts)) {
		echo $this->Form->create('CmsContent', array('url' => array('plugin' => 'cms', 'controller' => 'contents', 'action' => 'add')));
			echo $this->Form->input('layout_id');
			echo $this->Form->input('category_id');
			echo $this->Form->input('group_id', array('label' => __d('cms', 'Min Group')));
			echo $this->Form->input('title', array('class' => 'title'));
			echo $this->Infinitas->wysiwyg('CmsContent.body', array('toolbar' => 'AdminBasic'));
			echo $this->Form->input('active' );
		echo $this->Form->end(__d('cms', 'Save'));
	}
	else{
		if (empty($categories)) {
			$links[] = sprintf(
				__d('cms', 'No categories found, %s', true ),
				$this->Html->link(
					__d('cms', 'set some up', true ),
					array(
						'plugin' => 'contents',
						'controller' => 'global_categories',
						'action' => 'add'
					)
				)
			);
		}
		if (empty($layouts)) {
			$links[] = sprintf(
				__d('cms', 'No layouts found, %s', true ),
				$this->Html->link(
					__d('cms', 'set some up', true ),
					array(
						'plugin' => 'contents',
						'controller' => 'globa_categories',
						'action' => 'add'
					)
				)
			);
		}

		echo implode('<br/>', $links);
	}