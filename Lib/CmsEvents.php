<?php
class CmsEvents extends AppEvents {

/**
 * @brief get the plugin details
 *
 * @return array
 */
	public function onPluginRollCall(Event $Event) {
		return array(
			'name' => 'Cms',
			'description' => 'Content Management',
			'icon' => '/cms/img/icon.png',
			'author' => 'Infinitas',
			'dashboard' => array(
				'plugin' => 'cms',
				'controller' => 'cms_contents',
				'action' => 'dashboard'
			)
		);
	}

/**
 * @brief the admin menu
 *
 * @param type $event
 *
 * @return array
 */
	public function onAdminMenu(Event $Event) {
		$menu['main'] = array(
			'Dashboard' => array('plugin' => 'cms', 'controller' => 'cms_contents', 'action' => 'dashboard'),
			'Content' => array('plugin' => 'cms', 'controller' => 'cms_contents', 'action' => 'index'),
			'Front Page' => array('plugin' => 'cms', 'controller' => 'cms_frontpages', 'action' => 'index'),
			'Featured' => array('plugin' => 'cms', 'controller' => 'cms_features', 'action' => 'index'),
		);

		return $menu;
	}

/**
 * @brief set up cache for the plugin
 *
 * @return array
 */
	public function onSetupCache(Event $Event) {
		return array(
			'name' => 'cms',
			'config' => array(
				'duration' => 3600,
				'probability' => 100,
				'prefix' => 'cms.',
				'lock' => false,
				'serialize' => true
			)
		);
	}

/**
 * @brief generate url slugs
 *
 * @param Event $event
 * @param array $data
 *
 * @return array
 */
	public function onSlugUrl(Event $Event, $data = null, $type = null) {
		$data['data'] = isset($data['data']) ? $data['data'] : $data;
		$data['type'] = isset($data['type']) ? $data['type'] : 'contents';

		return parent::onSlugUrl($Event, $data['data'], $data['type']);
	}

/**
 * @brief a hard coded url for the cms dashboard
 *
 * @param Event $event
 */
	public function onSetupRoutes(Event $Event) {
		InfinitasRouter::connect('/admin/cms', array(
			'admin' => true,
			'prefix' => 'admin',
			'plugin' => 'cms',
			'controller' => 'cms_contents',
			'action' => 'dashboard'
		));
	}

/**
 * @brief parse a route and check if its belongs to the cms plugin
 *
 * return false if not a cms route, or the array if it is
 *
 * @param Event $event
 * @param array $data
 *
 * @return boolean|array
 */
	public function onRouteParse(Event $Event, $requestData = null) {
		$return = null;

		if ($requestData['action'] == 'comment') {
			unset($requestData['category'], $requestData['slug']);
			return $requestData;
		}

		$return = ClassRegistry::init('Cms.CmsContent')->find('routingInfo', array(
			'request' => InfinitasRouter::requestParams((array)$requestData)
		));
		if (!$return) {
			return false;
		}
		$requestData['infinitas'] = $return;
		return $requestData;
	}
}