<?php

define('APPLICATION_PATH',        realpath(dirname(__FILE__) . '/../'));
define('CONFIG_FILE',             APPLICATION_PATH . '/config/app.ini');

/**
 * DIRECTORY_SEPARATORを / に固定する
 */
define('DS', '/');

/**
 * Set mode
 */
defined('APPLICATION_MODE')
    or define('APPLICATION_MODE', 'front');

/**
 * Set run mode.
 */
defined('APPLICATION_ENVIRONMENT')
    or define('APPLICATION_ENVIRONMENT', 'development');

/**
 * Change current directory.
 */
chdir(realpath(dirname(__FILE__) . '/../../'));

/**
 * Initialize include path.
 */
$paths = array(
            '.',
            APPLICATION_PATH . '/../library',
            APPLICATION_PATH . '/models',
            APPLICATION_PATH . '/../external/pear',
            APPLICATION_PATH . '/../external/smarty',
            get_include_path()
        );
set_include_path(
    implode(PATH_SEPARATOR, $paths)
);

/**
 * Use auto loader.
 */
require_once "Ab/Loader/Autoloader.php";
$autoloader = Ab_Loader_Autoloader::getInstance();

