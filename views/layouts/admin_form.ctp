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

	echo $this->Form->create('Layout');
        echo $this->Infinitas->adminEditHead();	?>
		<fieldset>
			<h1><?php echo __('Content', true); ?></h1><?php
			echo $this->Form->input('id');
			echo $this->Form->input('name', array('class' => 'title'));
			echo $this->Form->input('css', array('class' => 'title'));
			echo $this->Cms->wysiwyg('Layout.html');
			// echo $this->Form->input('php', array('class' => 'title'));?>
		</fieldset><?php
	echo $this->Form->end();
?>
<div class="dashboard">
	<h1><?php __('Template Variables'); ?></h1>
	<ul>
		<li><?php echo __('The following items are available to use in the template', true); ?></li>
		<li>{{content.Content.slug}}</li>
		<li>{{content.Content.title}}</li>
		<li>{{content.Content.body}}</li>
		<li>{{content.Content.views}}</li>
		<li>{{content.Content.active}}</li>
		<li>{{content.Content.start}}</li>
		<li>{{content.Content.end}}</li>
		<li>{{content.Content.created}}</li>
		<li>{{content.Content.modified}}</li>
		<li>{{content.Content.rating}}</li>
		<li>{{content.Content.rating_count}}</li>
	</ul>
</div>