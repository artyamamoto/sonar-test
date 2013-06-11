<?php

class Ab_Setting
{
    protected static $_instance = null;

    protected $_table = null;

    protected function __construct()
    {
        $this->_table = new SettingTable();
    }

    public static function getInstance()
    {
        if(null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __get($key)
    {
        $row = $this->_table->fetchRow(array('code = ?' => $key));
        return $row ? $row->value : '';
    }
}

