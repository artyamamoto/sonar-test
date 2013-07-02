<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-25 at 17:02:38.
 * phpunit --bootstrap bootstrap.php IndexCoantrollerTest $(pwd)/tests/IndexCoantrollerTest.php
 */
/***
 * 内部でexit() しているため、このコントローラーはテストしない
 */
//class IndexControllerTest extends PHPUnit_Framework_TestCase
class ContactControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * @var IndexController
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        //$this->object = new IndexController;
		parent::setUp();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers IndexController::indexAction
     * @todo   Implement testIndexAction().
     */
    public function testFormAction()
    {
	//	$this->bootstrap->execute();
		$this->bootstrap = Ab_Application::getInstance();
		$this->bootstrap->init();
		$this->bootstrap->initView();
		$this->dispatch('/contact/form');
		//$this->assertRedirect();
		
		$this->assertModule('default');
		$this->assertController('contact');
		$this->assertAction('form');
		$this->assertNotRedirect();

    }
}