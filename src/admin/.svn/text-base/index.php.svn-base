<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

define("APPLICATION_MODE", "admin");
//define("APPLICATION_MODE", "front");
//define("APPLICATION_MODE", "cli");

if(isset($_SERVER['DEVEL']) && $_SERVER['DEVEL'] == 1) {
    define ("APPLICATION_ENVIRONMENT", "development");
} else {
    //define ("APPLICATION_ENVIRONMENT", "staging");
    define ("APPLICATION_ENVIRONMENT", "production");

    // SSL以外からのアクセスを禁止
    if($_SERVER['HTTPS'] != 'on') {
        header('HTTP/1.0 403 Forbidden');
        exit();
    }
}

require_once dirname(__FILE__) . '/../lib/application/config/init.php';

$application = new Ab_Application();
$application->run();

