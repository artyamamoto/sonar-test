<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//define("APPLICATION_MODE", "admin");
//define("APPLICATION_MODE", "front");
define("APPLICATION_MODE", "cli");

$develPath = '/Users/';
$stagePath = '/var/www/vhosts/stage.';

if(strpos(__FILE__, $develPath) !== false) {
    define ("APPLICATION_ENVIRONMENT", "development");
} elseif(strpos(__FILE__, $stagePath) !== false) {
    define ("APPLICATION_ENVIRONMENT", "staging");
} else {
    define ("APPLICATION_ENVIRONMENT", "production");
}

require_once dirname(__FILE__) . '/../lib/application/config/init.php';

$application = new Ab_Application();
$application->run();

