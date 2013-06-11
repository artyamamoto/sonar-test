<?php

class LoginController extends Ab_Controller_Action 
{
    protected $_menuTemplate = null;

    protected $_checkLogin = false;

    public function indexAction() 
    {
        $this->_helper->layout->setLayout('default_login');
    }

    public function authenticationAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session(APPLICATION_MODE));

        $db = Ab_Db_Table::getDefaultAdapter();

        $adapter = new Zend_Auth_Adapter_DbTable(
                            $db,
                            'administrator',
                            'mail_address',
                            'password',
                            'MD5(?) AND valid_flag = 1'
                        );

        $mailAddress = $this->_request->getParam('mail_address');
        $password    = $this->_request->getParam('password');

        if( $mailAddress == '' || $password == '' ) {
            $this->_forward('index');
            return;
        }

        $adapter->setIdentity($mailAddress)
                    ->setCredential($password);

        try {
            $result = $auth->authenticate($adapter);
        } catch( Exception $e) {
            // TODO: error handling
            echo $e->getMessage();
            exit();
        }

        $result->getCode(); // Zend_Auth_Result::SUCCESS
        $result->getIdentity(); // $username
        $result->getMessages(); // array() unless Zend_Auth_Result::FAILURE*

        if ($result->isValid()) {
            $auth->getStorage()->write($adapter->getResultRowObject());

            $administrator = $auth->getIdentity();

            // セッションIDをDBに保存
            $administratorTable = new AdministratorTable();
            $administratorTable->update(array('session_id' => session_id()), array('id = ?' => $administrator->id));

            $this->redirector->gotoAndExit('index', 'index');
        }

        $identity = $result->getIdentity();

        $this->_forward('index');
    }
}

