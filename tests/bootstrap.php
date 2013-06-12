<?php
if (defined("APPLICATION_MODE"))
	return;


define("APPLICATION_MODE", "front");
/*****
$stageFqdn = array(
    'stage.je-cp.com',
    'stage.js-cp.jp',
    'stage.wm-cp.jp',
    'stage.te-kan8.jp',
    'stage.pc-cp.jp',
);

if(isset($_SERVER['DEVEL']) && $_SERVER['DEVEL'] == 1) {
    define ("APPLICATION_ENVIRONMENT", "development");
} elseif(isset($_SERVER['SERVER_NAME']) && (in_array($_SERVER['SERVER_NAME'], $stageFqdn) || strpos($_SERVER['REQUEST_URI'], '/stage-') === 0)) {
    define ("APPLICATION_ENVIRONMENT", "staging");
} else {
    define ("APPLICATION_ENVIRONMENT", "production");
} *****/

define ("APPLICATION_ENVIRONMENT", "development");

require_once dirname(__FILE__).'/../src/lib/application/config/init.php';

$application = new Ab_Application();
// $application->run();
// $application->init();

class BootstrapTmp { 
	function init() {
        $config = new Zend_Config_Ini(
            CONFIG_FILE,
            array(APPLICATION_MODE, APPLICATION_ENVIRONMENT)
        );

        /**
         * Set timezone
         */
        date_default_timezone_set($config->system->timezone);


        /**
         * Set registry
         */
        $registry = Zend_Registry::getInstance();
        $registry->config = $this->_config = $config;
        //$registry->logger = $logger;
	}
}
$Bootstrap = new BootstrapTmp();
$Bootstrap->init();

