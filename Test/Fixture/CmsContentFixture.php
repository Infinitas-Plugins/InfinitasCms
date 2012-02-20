<?php
/* CmsContent Fixture generated on: 2010-08-17 14:08:56 : 1282055096 */
class CmsContentFixture extends CakeTestFixture {
	var $name = 'CmsContent';

	var $table = 'cms_contents';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'locked' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'locked_since' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'locked_by' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'views' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'start' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'end' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'layout_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'modified_by' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'rating' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_access' => array('column' => 'group_id', 'unique' => 0), 'idx_checkout' => array('column' => 'locked', 'unique' => 0), 'category_id' => array('column' => 'category_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 3,
			'title' => 'What is infinitas',
			'slug' => 'what-is-infinitas',
			'body' => '<p>\r\n	Over and above the core of infinitus is an easy to use api so anything that is not included in the core can be added through easy to develop plugins.&nbsp; With infinitas being built using the ever popular CakePHP&nbsp;framework there is countless plugins already developed that can be integrated with little or no modification.</p>\r\n<p>\r\n	The core of infinitas has been developed using the MVC standard of object orintated design.&nbsp; If you are an amature php deveeloper or a veteran you will find Infinitas easy to follow and even easier to expand on.&nbsp;</p>\r\n<p>\r\n	Now that you have Infinitas running your web site, you will have time to run your business.</p>\r\n',
			'locked' => 0,
			'locked_since' => '0000-00-00 00:00:00',
			'locked_by' => 0,
			'ordering' => 1,
			'group_id' => 2,
			'views' => 30,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created' => '2010-01-18 03:37:17',
			'modified' => '2010-04-12 11:28:57',
			'layout_id' => 1,
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 0,
			'rating_count' => 0
		),
		array(
			'id' => 4,
			'title' => 'Extending Infinitas',
			'slug' => 'extending-infinitas',
			'body' => '<p>\r\n	With infinitas built using the CakePHP&nbsp;framework with the MVC design pattern, adding functionality to your site could not be easier. Even if you are developing a plugin from scratch you have the Infinitas API&nbsp;at your disposal allowing you to create admin pages with copy / delete functionality with out even one line of code for example. Other functionalty like locking records, deleting traking creators, editors and dates content was last updated is all handled for you.</p>\r\n<p>\r\n	Full logging of create and update actions is done automaticaly and there is also full revisions of all models available.&nbsp; For more information see the development guide.</p>\r\n<p>\r\n	Future versions of Infinitas have a full plugin installer planed meaning you will not even need to use your ftp program to add plugins. The installer will work in two ways, the first being a normal installer like the one found in other popular cms&#39;s, and the second is a online installer that will display a list of trusted plugins that you can just select from.</p>\r\n',
			'locked' => 0,
			'locked_since' => '0000-00-00 00:00:00',
			'locked_by' => 0,
			'ordering' => 3,
			'group_id' => 2,
			'views' => 89,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created' => '2010-01-18 04:05:26',
			'modified' => '2010-04-16 21:14:40',
			'layout_id' => 1,
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 4.5,
			'rating_count' => 2
		),
		array(
			'id' => 5,
			'title' => 'Contributing to Infinitas',
			'slug' => 'contributing-to-infinitas',
			'body' => '<p>\r\n	Open source software is all about the community around the application, and Infinitas is no different. With out users and developers contributing Infinitas would not get anywere. To help make it as easy as possible, we have the code hosted on <a href=\"http://github.com/infinitas\" target=\"_blank\">git</a> and the issues are being tracked on <a href=\"http://infinitas.lighthouseapp.com/dashboard\">lighthouse</a>.&nbsp; There is a lot of information for developers that are interested in helping with Infinitas on lighthouse.</p>\r\n<p>\r\n	We have a channel on irc where you can come and chat to us about issues you are having, or if you need some help integrating code / developing an application with Infinitas. We will be more than happy to help you were we can.</p>\r\n<p>\r\n	If you find an issues and would like to fix it all you need to do is have a look at the details on <a href=\"http://infinitas.lighthouseapp.com/contributor-guidelines\" target=\"_blank\">lighthouse</a>.&nbsp; Once you have submitted a patch or pushed your code fixes, dont forget to send us a pull request or let us know in the irc channel that there is code we need to pull.</p>',
			'locked' => 0,
			'locked_since' => '0000-00-00 00:00:00',
			'locked_by' => 0,
			'ordering' => 2,
			'group_id' => 2,
			'views' => 3,
			'active' => 1,
			'start' => '0000-00-00 00:00:00',
			'end' => '0000-00-00 00:00:00',
			'created' => '2010-01-18 04:17:50',
			'modified' => '2010-04-12 11:29:07',
			'layout_id' => 1,
			'created_by' => 0,
			'modified_by' => 0,
			'category_id' => 1,
			'rating' => 0,
			'rating_count' => 0
		),
	);
}
?>