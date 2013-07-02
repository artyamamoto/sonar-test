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

isset($_SERVER["HTTP_USER_AGENT"] ) || 
	($_SERVER["HTTP_USER_AGENT"] = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16");
isset($_SERVER["HTTPS"]) || 
	($_SERVER["HTTPS"] = "off");
isset($_SERVER["REMOTE_ADDR"]) || 
	($_SERVER["REMOTE_ADDR"] = "127.0.0.1");
isset($_SERVER["SERVER_NAME"]) || 
	($_SERVER["SERVER_NAME"] = "stage.je-cp.com");
isset($_SERVER["REQUEST_URI"]) || 
	($_SERVER["REQUEST_URI"] = "/contact/notice");


require_once dirname(__FILE__).'/../src/lib/application/config/init.php';

//$application = Ab_Application::getInstance();
// $application->run();
//$application->init();
//$application->initView();


class TestConfig {
	public static $db;
	function init() {
		switch(true) {
			case strpos(php_uname(),'yamamotokazuaki') !== false:
				TestConfig::$db = array(
					"host" => "localhost" ,
					"username" => "root" , 
					"password" => "" , 
					"dbname" => "phpunit" ,
				);
			break;
			case strpos(php_uname(),'ip-10-122-20-190') !== false :
				TestConfig::$db = array(
					"host" => "sonar.cbcj1uaveecq.ap-northeast-1.rds.amazonaws.com" ,
					"username" => "sonar" , 
					"password" => "sonar1234" , 
					"dbname" => "phpunit" ,
				);
			break;
			default:
				TestConfig::$db = array(
					"host" => "sonar-instance.ct6ddgfemi2m.ap-northeast-1.rds.amazonaws.com" ,
					"username" => "sonar" , 
					"password" => "sonar1234" , 
					"dbname" => "phpunit" ,
				);
			break;
		}
		$SQL = sprintf('mysql -u %s -h %s ' , self::$db["username"] , self::$db["host"] );
		if (!empty(self::$db["password"]))
			$SQL .= "-p".self::$db["password"]." ";
		$SQL .= sprintf('%s < %s/datas/table.sql' , 
						self::$db["dbname"]  , dirname(__FILE__) );
		
		//echo "current dir: ".getcwd()."\n";
		echo "(bootstrap) exec: $SQL\n";
		shell_exec($SQL);
	}
}
TestConfig::init();

class BootstrapTmp { 
	function init() {
if (0):
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

endif;
		/***
		 * init Database 
		 **/
        $dbAdapter = Zend_Db::factory("mysqli",
			TestConfig::$db + array(
                "charset"  => "UTF8",
                "adapterNamespace" => "Zend_Db_Adapter",
        	));
        Ab_Db_Table::setDefaultAdapter($dbAdapter);
        Zend_Registry::getInstance()->dbAdapter = $dbAdapter;

	}
}
$Bootstrap = new BootstrapTmp();
$Bootstrap->init();

