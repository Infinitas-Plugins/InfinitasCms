<?php
	if(!$requreSetup) { ?>
		<div class="dashboard grid_16">
			<h1><?php echo __d('cms', 'Please setup the CMS before use'); ?></h1>
			<p class="info">
				<?php
					echo sprintf(
						__d('cms', 'Add some %s before you create content'),
						$this->Html->link(
							__d('contents', 'layouts'),
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
			'name' => __('List'),
			'description' => __('View all your content pages'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_contents', 'action' => 'index')
		),
		array(
			'name' => __('Add'),
			'description' => __('Create a new content page'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_contents', 'action' => 'add')
		),
		array(
			'name' => __('Active'),
			'description' => __('See what items are currently active'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_contents', 'action' => 'index', 'CmsContent.active' => 1)
		),
		array(
			'name' => __('Pending'),
			'description' => __('See what items are currently pending'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_contents', 'action' => 'index', 'CmsContent.active' => 0)
		)
	);

	$links['front'] = array(
		array(
			'name' => __('List'),
			'description' => __('View the pages currently set to show on the main page'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_frontpages', 'action' => 'index')
		),
		array(
			'name' => __('Add'),
			'description' => __('Add some new pages to the main page'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_frontpages', 'action' => 'add')
		)
	);

	$links['featured'] = array(
		array(
			'name' => __('List'),
			'description' => __('View the current featured items'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_features', 'action' => 'index')
		),
		array(
			'name' => __('Add'),
			'description' => __('Add some new featured items'),
			'icon' => '/cms/img/icon.png',
			'dashboard' => array('controller' => 'cms_features', 'action' => 'add')
		)
	);
?>
<div class="dashboard grid_16">
	<h1><?php echo __d('cms', 'Content'); ?></h1>
	<?php echo $this->Design->arrayToList(current($this->Menu->builDashboardLinks($links['main'], 'cms_main_icons')), 'icons'); ?>
	<p class="info"><?php echo Configure::read('Cms.info.content'); ?></p>
</div>
<?php
	echo $this->element('Contents.modules/admin/dashboard_links');
	
	if(!$hasContent) { ?>
		<div class="dashboard grid_16">
			<h1><?php echo __d('cms', 'No Content'); ?></h1>
			<p class="info"><?php echo __d('cms', 'Add some content for advanced CMS functionality'); ?></p>
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
		'ViewCounter.modules/admin/popular_items',
		array(
			'model' => 'Cms.CmsContent'
		)
	);