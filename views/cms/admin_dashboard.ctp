<div class="dashboard grid_16">
	<h1>Content</h1>
	<ul class="icons">
		<li>
			<?php echo $this->Html->link(__('List', true), array('controller' => 'contents', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this->Html->link(__('Add', true), array('controller' => 'contents', 'action' => 'add')); ?>
		</li>
		<li>
			<?php echo $this->Html->link(__('Active', true), array('controller' => 'contents', 'action' => 'index', 'Content.active' => 1)); ?>
		</li>
		<li>
			<?php echo $this->Html->link(__('Pending', true), array('controller' => 'contents', 'action' => 'index', 'Content.active' => 0)); ?>
		</li>
	</ul>
	<p class="info"><?php echo Configure::read('Cms.info.content'); ?></p>
</div>
<div class="dashboard grid_8 half">
	<h1>Frontpage Items</h1>
	<ul class="icons">
		<li>
			<?php echo $this->Html->link(__('List', true), array('controller' => 'frontpages', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this->Html->link(__('Add', true), array('controller' => 'frontpages', 'action' => 'add')); ?>
		</li>
	</ul>
	<p class="info"><?php echo Configure::read('Cms.info.frontpages'); ?></p>
</div>
<div class="dashboard grid_8 half">
	<h1>Featured Items</h1>
	<ul class="icons">
		<li>
			<?php echo $this->Html->link(__('List', true), array('controller' => 'features', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this->Html->link(__('Add', true), array('controller' => 'features', 'action' => 'add')); ?>
		</li>
	</ul>
	<p class="info"><?php echo Configure::read('Cms.info.featured'); ?></p>
</div>

<?php echo $this->element('modules/admin/popular_items', array('plugin' => 'view_counter', 'class' => 'Cms.content')); ?>