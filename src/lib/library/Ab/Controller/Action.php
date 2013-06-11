<?php

/**
 * Ab_Controller_Action class.
 *
 * @package Ab
 * @author  M/Kamoshida
 */
class Ab_Controller_Action extends Zend_Controller_Action
{
    /**
     * @var string
     */
    protected $_menuTemplate = null;

    /**
     * @var string
     */
    protected $_menuSelected = null;

    /**
     * @var boolean
     */
    protected $_checkLogin = true;

    /**
     * @var Ab_Controller_Request_Http
     */
    protected $_request;

    /**
     * @var Administrator
     */
    protected $_administrator;

    /**
     * @var Zend_Controller_Action_Helper_Redirector
     */
    public $redirector;

    /**
     * @var int
     */
    protected $_itemCountPerPage = 20;

    /**
     * @var Ab_Log
     */
    protected $_logger = null;

    /**
     * Initialize.
     *
     * @access public
     */
    public function init()
    {
        $this->_helper->layout->setLayout('default');

        $this->redirector = $this->_helper->getHelper('redirector');

        $this->_request = $this->getRequest();

        $this->_loginCheck();

        $this->_logger = Zend_Registry::getInstance()->logger;
    }

    protected function _loginCheck()
    {
        /**
         * authentication
         */
        if($this->_checkLogin) {
            $auth = Zend_Auth::getInstance();
            $auth->setStorage(new Zend_Auth_Storage_Session(APPLICATION_MODE));
            if($auth->hasIdentity()) {
                $this->_administrator = $auth->getIdentity();
            } else {
                $this->redirector->gotoAndExit('index', 'login');
            }
        }
    }

    /**
     * Pre dispatch.
     *
     * @access public
     */
    public function preDispatch()
    {
    }

    /**
     * Post dispatch.
     *
     * @access public
     */
    public function postDispatch()
    {
        $this->view->request = $this->_request;

        $this->view->administrator = $this->_administrator;

        if(Ab_Layout::getMvcInstance()->isEnabled()) {
            $response = $this->getResponse();

            $this->view->menuSelected = $this->_menuSelected;
            if(null !== $this->_menuTemplate) {
                $response->insert('menu', $this->view->render($this->_menuTemplate));
            } else {
                $response->insert('menu', '');
            }
        }

        $this->view->config = Zend_Registry::getInstance()->config;

        $this->view->this = $this;

        $this->view->title = null;
    }

    /**
     * Set paginator.
     *
     * @access public
     * @param  Ab_Db_Table      $table
     */
    public function paginate($table, $order = null)
    {
        $tablePrimaryKey = $table->info(Ab_Db_Table::PRIMARY);
        $db              = $table->getAdapter();

        $select = $db->select();
        $this->_setPaginateFrom($select, $table);
        $this->_setPaginateCondition($select);
        if(null === $order) {
            $order = $tablePrimaryKey;
        }
        $select->order($order);

        $this->view->paginator = $paginator = Ab_Paginator::factory($select);
        $paginator->setItemCountPerPage($this->_itemCountPerPage);
        $paginator->setCurrentPageNumber($this->_request->page);
    }

    /**
     * Set paginating from.
     *
     * @access protected
     * @param  Zend_Db_Table_Select $select
     * @param  Ab_Db_Table          $table
     */
    protected function _setPaginateFrom($select, $table)
    {
        $tableName = $table->info(Ab_Db_Table::NAME);
        $select->from($tableName);
    }

    /**
     * Set paginating condition.
     *
     * @access protected
     * @param  Zend_Db_Table_Select $select
     */
    protected function _setPaginateCondition($select)
    {
    }

    /**
     * Validator.
     *
     * @access public
     * @return boolean
     */
    public function validate($rules = null)
    {
        if(null === $rules) {
            $rules = $this->getValidatorRules();
        }

        $validator = new Ab_Validate_Request($rules);
        if ($validator->isValid($this->_request->getParams())) {
            $this->view->errors = $validator->getErrors();
            $this->_forward('input');
            return false;
        }
        return true;
    }
}

