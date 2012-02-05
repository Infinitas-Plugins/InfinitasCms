<?php
	if(!$requreSetup) { ?>
		<div class="dashboard grid_16">
			<h1><?php echo __d('cms', 'Please setup the CMS before use', true); ?></h1>
			<p class="info">
				<?php
					echo sprintf(
						__d('cms', 'Add some %s before you create content', true),
						$this->Html->link(
							__d('contents', 'layouts', true),
							array(
								'plugin' => 'contents',
								'controller' => 'global_layouts',
								'action' => 'add'
							)
						)
					);
				?>
			</p>
		</div> <?php
		return;
	}
	
	$links = array();
	$links['main'] = array(
		array(
			'name' => __('Categories', true),
			'description' => __('Configure the categories for your content', true),
			'icon' => '/categories/img/icon.png',
			'dashboard' => array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'index')
		),
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

	$links['config'] = array(
		array(
			'name' => __('Layouts', true),
			'description' => __('Configure the layouts for your content', true),
			'icon' => '/contents/img/icon.png',
			'dashboard' => array('plugin' => 'contents', 'controller' => 'global_layouts', 'action' => 'index', 'GlobalLayout.model' => 'Cms')
		),
		array(
			'name' => __('Routes', true),
			'description' => __('Manage content routes', true),
			'icon' => '/routes/img/icon.png',
			'dashboard' => array('plugin' => 'routes', 'controller' => 'routes', 'action' => 'index', 'Route.plugin' => 'Cms')
		),
		array(
			'name' => __('Modules', true),
			'description' => __('Manage content modules', true),
			'icon' => '/modules/img/icon.png',
			'dashboard' => array('plugin' => 'modules', 'controller' => 'modules', 'action' => 'index', 'Module.plugin' => 'Cms')
		),
		array(
			'name' => __('Assets', true),
			'description' => __('Manage content assets', true),
			'icon' => '/filemanager/img/icon.png',
			'dashboard' => array('plugin' => 'filemanager', 'controller' => 'filemanager', 'action' => 'index', 'webroot', 'img')
		),
		array(
			'name' => __('Locked', true),
			'description' => __('Manage locked content', true),
			'icon' => '/locks/img/icon.png',
			'dashboard' => array('plugin' => 'locks', 'controller' => 'locks', 'action' => 'index', 'Lock.class' => 'Cms')
		),
		array(
			'name' => __('Trash', true),
			'description' => __('View / Restore previously removed content', true),
			'icon' => '/trash/img/icon.png',
			'dashboard' => array('plugin' => 'trash', 'controller' => 'trash', 'action' => 'index', 'Trash.model' => 'Cms')
		)
	);

	if($this->Infinitas->hasPlugin('ViewCounter')) {
		$links['config'][] =  array(
			'name' => __('Views', true),
			'description' => __d('cms', 'Track content popularity', true),
			'icon' => '/view_counter/img/icon.png',
			'dashboard' => array('plugin' => 'view_counter', 'controller' => 'view_counts', 'action' => 'reports', 'ViewCount.model' => 'Cms')
		);
	}

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
	<h1><?php __d('cms', 'Content'); ?></h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['main'], 'cms_main_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.content'); ?></p>
</div>
<div class="dashboard grid_16">
	<h1><?php __d('cms', 'Config / Data'); ?></h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['config'], 'cms_config_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.config'); ?></p>
</div>
<?php
	if(!$hasContent) { ?>
		<div class="dashboard grid_16">
			<h1><?php echo __d('cms', 'No Content', true); ?></h1>
			<p class="info"><?php echo __d('cms', 'Add some content for advanced CMS functionality', true); ?></p>
		</div> <?php
		return;
	}
?>
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