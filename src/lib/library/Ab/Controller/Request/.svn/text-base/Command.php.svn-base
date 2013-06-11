<?php

class Ab_Controller_Request_Command extends Zend_Controller_Request_Abstract
{
    public function __construct()
    {
        global $argv;

        $short = array(
                    'a' => 'action',
                    'c' => 'controller',
                );

        $params = array();
        $paramName = null;
        foreach($argv as $s) {
            if($s[0] == '-') {
                if(null !== $paramname) {
                    $params[$paramName] = 1;
                    $paramName = null;
                }

                if($s[1] == '-') {
                    // --[key]=[val]
                    list($paramName, $val) = explode('=', $s, 2);
                    $paramName = substr($paramName, 2);
                    $params[$paramName] = $val;
                } else {
                    // -[key] [val]
                    $paramName = isset($short[$s[1]]) ? $short[$s[1]] : null;
                }
            } elseif(null !== $paramName) {
                $params[$paramName] = $s;
                $paramName = null;
            }
        }

        if(isset($params['action'])) {
            $this->setActionName($params['action']);
            unset($params['action']);
        }
        if(isset($params['controller'])) {
            $this->setControllerName($params['controller']);
            unset($params['controller']);
        }

        $this->setParams($params);
    }

    public function __get($key)
    {
        switch (true) {
            case isset($this->_params[$key]):
                return $this->_params[$key];
            case isset($_SERVER[$key]):
                return $_SERVER[$key];
            case isset($_ENV[$key]):
                return $_ENV[$key];
            default:
                return null;
        }
    }
}

