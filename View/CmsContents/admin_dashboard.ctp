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
		'name' => __d('cms', 'List'),
		'description' => __d('cms', 'View all your content pages'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_contents', 'action' => 'index')
	),
	array(
		'name' => __d('cms', 'Add'),
		'description' => __d('cms', 'Create a new content page'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_contents', 'action' => 'add')
	),
	array(
		'name' => __d('cms', 'Active'),
		'description' => __d('cms', 'See what items are currently active'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_contents', 'action' => 'index', 'CmsContent.active' => 1)
	),
	array(
		'name' => __d('cms', 'Pending'),
		'description' => __d('cms', 'See what items are currently pending'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_contents', 'action' => 'index', 'CmsContent.active' => 0)
	)
);

$links['front'] = array(
	array(
		'name' => __d('cms', 'List'),
		'description' => __d('cms', 'View the pages currently set to show on the main page'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_frontpages', 'action' => 'index')
	),
	array(
		'name' => __d('cms', 'Add'),
		'description' => __d('cms', 'Add some new pages to the main page'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_frontpages', 'action' => 'add')
	)
);

$links['featured'] = array(
	array(
		'name' => __d('cms', 'List'),
		'description' => __d('cms', 'View the current featured items'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_features', 'action' => 'index')
	),
	array(
		'name' => __d('cms', 'Add'),
		'description' => __d('cms', 'Add some new featured items'),
		'icon' => '/cms/img/icon.png',
		'dashboard' => array('controller' => 'cms_features', 'action' => 'add')
	)
);

foreach($links as $name => &$link) {
	$link = $this->Design->arrayToList(current((array)$this->Menu->builDashboardLinks($link, 'shop_dashboard_' . $name)), array(
		'ul' => 'icons'
	));
}

echo $this->Design->dashboard($links['main'], __d('cms', 'Content'), array(
	'class' => 'dashboard span6',
	'info' => Configure::read('Cms.info.content')
));

echo $this->element('Contents.modules/admin/dashboard_links');

if(!$hasContent) {
	echo $this->Design->dashboard('', __d('cms', 'No Content'), array(
		'class' => 'dashboard',
		'alert' => __d('cms', 'Add some content for advanced CMS functionality')
	));
	return;
}

echo $this->Design->dashboard($links['front'], __d('cms', 'Frontpage Items'), array(
	'class' => 'dashboard span6',
	'info' => Configure::read('Cms.info.frontpages')
));

echo $this->Design->dashboard($links['featured'], __d('cms', 'Featured Items'), array(
	'class' => 'dashboard span6',
	'info' => Configure::read('Cms.info.featured')
));

echo $this->element('ViewCounter.modules/admin/popular_items', array(
	'model' => 'Cms.CmsContent'
));