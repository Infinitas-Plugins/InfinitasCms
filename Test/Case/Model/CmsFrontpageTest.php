<?php
	/* ContentFrontpage Test cases generated on: 2009-12-13 19:12:29 : 1260726929*/
	App::uses('CmsFrontpage', 'Cms.Model');

	class CmsFrontpageTestCase extends CakeTestCase
	{
		public $fixtures = array(
			'plugin.cms.cms_content',
			'plugin.cms.cms_frontpage',
	    );

	    public function startTest() {
	        $this->CmsFrontpage = &ClassRegistry::init('Cms.CmsFrontpage');
	    }

		public function testSomething() {
			$this->assertTrue(true);
		}

	    public function endTest() {
	        unset( $this->CmsFrontpage );
	        ClassRegistry::flush();
	    }
	}