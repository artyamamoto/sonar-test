<?php

class Ab_Device
{
    protected static $_instance = null;

    protected $_userAgent = null;

    protected function __construct()
    {
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown/0.0';

        $this->_userAgent = Net_UserAgent_Mobile::factory($userAgent);
    }

    public static function getInstance()
    {
        if(null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getTypeString()
    {
        $config = Zend_Registry::getInstance()->config;

        if($this->isMobile()) {
            $ret = $config->device->type->mobile;
        } elseif($this->isSmartphone()) {
            $ret = $config->device->type->smartphone;
        } else {
            $ret = $config->device->type->pc;
        }

        return $ret;
    }

    public function isSmartphone()
    {
        return ($this->isAndroid() || $this->isIphone());
    }

    public function isAndroid()
    {
        return (stripos($this->_userAgent->_userAgent, 'android') !== false ? true : false);
    }

    public function isIphone()
    {
        if(stripos($this->_userAgent->_userAgent, 'iphone') !== false) {
            return true;
        }

        if(stripos($this->_userAgent->_userAgent, 'ipad') !== false) {
            return true;
        }

        return false;
    }

    public function isMobile()
    {
        if($this->_userAgent instanceof Net_UserAgent_Mobile_DoCoMo) {
            return true;
        }
        if($this->_userAgent instanceof Net_UserAgent_Mobile_EZweb) {
            return true;
        }
        if($this->_userAgent instanceof Net_UserAgent_Mobile_SoftBank) {
            return true;
        }

        return false;
    }

    public function isDoCoMo()
    {
        return $this->_userAgent->isDoCoMo();
    }

    public function isEZweb()
    {
        return $this->_userAgent->isEZweb();
    }

    public function isSoftBank()
    {
        return $this->_userAgent->isSoftBank();
    }

    public function getCarrier()
    {
        return $this->_userAgent->getCarrierLongName();
    }

    public function getModel()
    {
        return $this->_userAgent->getModel();
    }

    public function getUid()
    {
        return $this->_userAgent->getUID();
    }

    public function getUserAgent()
    {
        return $this->_userAgent->getUserAgent();
    }
}

