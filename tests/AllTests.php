<?php

require_once "PHPUnit/Framework/TestSuite.php";
require_once dirname(__FILE__).'/Ab_DeviceTest.php';

class AllTest {
	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite;
		$suite->addTest(new Ab_DeviceTest('Ab_Device'));
	}
}
AllTest::main();

