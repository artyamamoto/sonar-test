<?php

/**
 * ErrorController
 */
class ErrorController extends Ab_Controller_Action
{
    protected $_checkLogin = false;

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                $this->getResponse()->setHttpResponseCode(404);
                $message = 'Page not found';
                break;
            default:
                $this->getResponse()->setHttpResponseCode(500);
                $message = 'Application error';
                break;
        }

        echo 'Error' . PHP_EOL;
        echo $message . PHP_EOL;
        echo $errors->exception->getMessage() . PHP_EOL;
        echo PHP_EOL;
        echo $errors->exception->getFile() . ' : ' . $errors->exception->getLine() . PHP_EOL;
        echo PHP_EOL;
        echo $errors->exception->getTraceAsString() . PHP_EOL;
        exit();
    }
}

