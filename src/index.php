<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//define("APPLICATION_MODE", "admin");
define("APPLICATION_MODE", "front");
//define("APPLICATION_MODE", "cli");

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
}

require_once dirname(__FILE__) . '/lib/application/config/init.php';

$application = new Ab_Application();
$application->run();

