<?php
	$links = array();
	$links['main'] = array(
		array(
			'name' => __('List', true),
			'description' => __('View all your content pages', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'contents', 'action' => 'index')
		),
		array(
			'name' => __('Add', true),
			'description' => __('Create a new content page', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'contents', 'action' => 'add')
		),
		array(
			'name' => __('Active', true),
			'description' => __('See what items are currently active', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'contents', 'action' => 'index', 'Content.active' => 1)
		),
		array(
			'name' => __('Pending', true),
			'description' => __('See what items are currently pending', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'contents', 'action' => 'index', 'Content.active' => 0)
		)
	);

	$links['front'] = array(
		array(
			'name' => __('List', true),
			'description' => __('View the pages currently set to show on the main page', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'frontpages', 'action' => 'index')
		),
		array(
			'name' => __('Add', true),
			'description' => __('Add some new pages to the main page', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'frontpages', 'action' => 'add')
		)
	);

	$links['featured'] = array(
		array(
			'name' => __('List', true),
			'description' => __('View the current featured items', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'features', 'action' => 'index')
		),
		array(
			'name' => __('Add', true),
			'description' => __('Add some new featured items', true),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'features', 'action' => 'add')
		)
	);
?>
<div class="dashboard grid_16">
	<h1>Content</h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['main'], 'cms_main_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.content'); ?></p>
</div>

<div class="dashboard grid_8 half">
	<h1>Frontpage Items</h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['front'], 'cms_front_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.frontpages'); ?></p>
</div>

<div class="dashboard grid_8 half">
	<h1>Featured Items</h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['featured'], 'cms_featured_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.featured'); ?></p>
</div>
<?php 
	echo $this->element(
		'modules/admin/popular_items',
		array(
			'plugin' => 'view_counter',
			'model' => 'Cms.content'
		)
	);
?>