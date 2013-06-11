<?php

/**
 * Application
 *
 * @author M/Kamoshida
 * @create 2010/12/02
 */
class Ab_Application
{
    /**
     * @var Zend_Config_Ini
     */
    protected $_config = null;

    /**
     * @var Ab_Controller_Request
     */
    protected $_request;

    /**
     * @var Ab_Controller_Response
     */
    protected $_response;

    /**
     * Constructor.
     *
     * @access public
     */
    public function __construct()
    {
    }

    /**
     * Run application.
     *
     * @access public
     */
    public function run()
    {
        try {
            $this->init();

            $this->initView();

            $this->initDatabase();

            $this->execute();
        } catch (Exception $e) {
            $response = Zend_Controller_Front::getInstance()->getResponse();

            if(null !== $response) {
                $response->setHttpResponseCode(500);
            }

            if(class_exists('Zend_Registry') && isset(Zend_Registry::getInstance()->logger)) {
                Zend_Registry::getInstance()->logger->crit($e->getMessage());
            } else {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Initialize application.
     *
     * @access public
     */
    public function init()
    {
        /**
         * Load configuration file.
         */
        $config = new Zend_Config_Ini(
            CONFIG_FILE,
            array(APPLICATION_MODE, APPLICATION_ENVIRONMENT)
        );

        /**
         * Set timezone
         */
        date_default_timezone_set($config->system->timezone);

        /**
         * Setup logger
         */
        $logger = new Ab_Log();
        $logger->init($config->log->dir, (int)$config->log->start);

        /**
         * Set error handler
         */
        set_error_handler(array('Ab_Log', 'errorHandler'));

        /**
         * Set registry
         */
        $registry = Zend_Registry::getInstance();
        $registry->config = $this->_config = $config;
        $registry->logger = $logger;

        /**
         * Setup dispatcher.
         */
        $dispatcher = new Zend_Controller_Dispatcher_Standard();
//        $dispatcher->setPathDelimiter('_');
//        $dispatcher->setWordDelimiter(array('-', '.'));
        $dispatcher->setPathDelimiter('/');
        $dispatcher->setWordDelimiter(array('_', '-', '.'));

        /**
         * Setup controller.
         */
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->setDispatcher($dispatcher);

        $frontController->setControllerDirectory(
            array(
                'default' => $config->controller->dir,
            )
        );

        //$frontController->setControllerDirectory($config->controller->dir);
        $frontController->setParam('env', APPLICATION_ENVIRONMENT);

        /**
         * Device
         */
        $device = Ab_Device::getInstance();

        /**
         * Setup router
         */
        $class = 'Ab_Controller_Router_' . $config->run->router;
        $router = new $class();
        if(isset($config->routes)) {
            $router->addConfig($config, 'routes');
        }

        $frontController->setRouter($router);

        /**
         * Set controllers path
         */
        $paths = array(
                    get_include_path(),
                    $config->controller->dir,
                );
        set_include_path(implode(PATH_SEPARATOR, $paths));

        /**
         * Get request and response object.
         */
        $class = 'Ab_Controller_Request_' . $this->_config->run->request;
        $this->_request = new $class();

        $class = 'Ab_Controller_Response_' . $this->_config->run->response;
        $this->_response = new $class();

        // 携帯の場合は、入出力の文字コードをCP932
        if($device->isMobile()) {
            $this->_request->setInputEncoding('CP932');
            $this->_response->setOutputEncoding('CP932');
        }
    }

    /**
     * Setup layout and view with Smarty.
     */
    public function initView()
    {
        $viewOption = $this->_config->template->params->toArray();
        $viewSuffix = $this->_config->template->suffix;

        $view       = new Ab_View_Smarty(null, $viewOption);
        $view->assign('system', $this->_config->system);

        $viewRender = new Ab_Controller_Action_Helper_ViewRenderer();
        $viewRender->setView($view)
                   ->setViewSuffix($viewSuffix)
                   ->setViewBasePathSpec($this->_config->template->base_path);

        Zend_Controller_Action_HelperBroker::addHelper($viewRender);

        $layoutDir = $this->_config->template->layout->dir;
        $layout = Ab_Layout::startMvc($layoutDir);
        $layout->setViewSuffix($viewSuffix);
    }

    /**
     * Setup database.
     *
     * @acces public
     */
    public function initDatabase()
    {
	$dbAdapter = null;
	
        // $dbAdapter = Zend_Db::factory($this->_config->database);
        $dbAdapter = Zend_Db::factory("mysqli",array(
		"host"     => $_SERVER["RDS_HOSTNAME"],
		"username" => $_SERVER["RDS_USERNAME"],
		"password" => $_SERVER["RDS_PASSWORD"],
		"dbname"   => $_SERVER["RDS_DB_NAME"] ,
		"charset"  => "UTF8",
		"adapterNamespace" => "Zend_Db_Adapter",
	));
	
	Ab_Db_Table::setDefaultAdapter($dbAdapter);
        $registry->dbAdapter = $dbAdapter;
//        $dbAdapter->query('set names UTF8');
    }

    /**
     * Execute application.
     *
     * @acces public
     */
    public function execute()
    {
        // Dispatch.
        Zend_Controller_Front::getInstance()->dispatch($this->_request, $this->_response);
    }
}

