<?php
	if (!empty($categories) && !empty($layouts)) {
		echo $this->Form->create('CmsContent', array('url' => array('plugin' => 'cms', 'controller' => 'contents', 'action' => 'add')));
			echo $this->Form->input('layout_id');
			echo $this->Form->input('category_id');
			echo $this->Form->input('group_id', array('label' => __('Min Group')));
			echo $this->Form->input('title', array('class' => 'title'));
			echo $this->Infinitas->wysiwyg('CmsContent.body', array('toolbar' => 'AdminBasic'));
			echo $this->Form->input('active' );
		echo $this->Form->end(__('Save'));
	}
	else{
		if (empty($categories)){
			$links[] = sprintf(
				__('No categories found, %s', true ),
				$this->Html->link(
					__('set some up', true ),
					array(
						'plugin' => 'contents',
						'controller' => 'global_categories',
						'action' => 'add'
					)
				)
			);
		}
		if (empty($layouts)){
			$links[] = sprintf(
				__('No layouts found, %s', true ),
				$this->Html->link(
					__('set some up', true ),
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