<?php
	/**
	 *
	 *
	 */
	class Layout extends CmsAppModel{
		public $name = 'Layout';

		public $lockable = true;

		public $useTable = 'content_layouts';

		public $hasMany = array(
			'Content' => array(
				'className' => 'Cms.Content',
				'foreignKey' => 'layout_id',
			),
		);

		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'name' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter the name of this template', true)
					),
					'isUnique' => array(
						'rule' => 'isUnique',
						'message' => __('There is already a template with that name', true)
					)
				),
				'html' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please create the html for your template', true)
					)
				)
			);
		}
	}