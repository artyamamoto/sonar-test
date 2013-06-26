<?php
class IndexController extends BaseController
{
    public function indexAction() 
    {
        $this->redirector->gotoAndExit('index', 'page');
    }
}

