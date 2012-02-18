<?php
	/* 
	 * Short Description / title.
	 * 
	 * Overview of what the file does. About a paragraph or two
	 * 
	 * Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * 
	 * @filesource
	 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * @link http://www.infinitas-cms.org
	 * @package {see_below}
	 * @subpackage {see_below}
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since {check_current_milestone_in_lighthouse}
	 * 
	 * @author {your_name}
	 * 
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */

	 $config['Cms'] = array(
		 'allow_comments' => true,
		 'allow_ratings' => true,
		 'auto_redirect' => true,
		 'info' => array(
			 'content' => __d('cms', 'You can view the content on your site now using the list icons now. You can see everything or filter out active or disabled content also. You can add new content using the add icon.'),
			 'frontpages' => __d('cms', 'Cms front pages are the items that will show when a user visits the main url for your cms section of the site. This is normaly site.com/cms'),
			 'featured' => __d('cms', 'Featured items are just a way to make a content item stand out from the other content items that you have on your site.'),
			 'config' => __d('cms', 'Configure and manage how your content is displayed. Create different SEO urls, manage images, restore trash and more')
		 ),
		 'slugUrl' => array(
			 'contents' => array(
				 'Content.id' => 'id',
				 'CmsContent.id' => 'id',
				 'Content.slug' => 'slug',
				 'CmsContent.slug' => 'slug',
				 'GlobalCategory.slug' => 'category',
				 'url' => array(
					 'plugin' => 'cms',
					 'controller' => 'cms_contents',
					 'action' => 'view'
				 )
			 ),
		 ),
	 );