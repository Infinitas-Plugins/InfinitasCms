<?php
App::uses('AllTestsBase', 'Test/Lib');

class AllCmsTestsTest extends AllTestsBase {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Cms tests');

		$path = CakePlugin::path('Cms') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}
}
