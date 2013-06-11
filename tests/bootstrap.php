<?php
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


