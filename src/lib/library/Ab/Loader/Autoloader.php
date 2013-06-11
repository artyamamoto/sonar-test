<?php

require_once "Zend/Loader/Autoloader.php";

/**
 * Ab_Loader_Autoloader class.
 */
class Ab_Loader_Autoloader extends Zend_Loader_Autoloader
{
    /**
     * Retrieve singleton instance
     *
     * @return Zend_Loader_Autoloader
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Registers instance with spl_autoload stack
     *
     * @return void
     */
    protected function __construct()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        $this->_internalAutoloader = array($this, '_autoload');

        $this->setFallbackAutoloader(true);
    }
}

