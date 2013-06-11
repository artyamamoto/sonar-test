<?php

class Ab_Controller_Request_Http extends Zend_Controller_Request_Http
{
    protected $_inputEncoding = null;

    public function setInputEncoding($encode)
    {
        $this->_inputEncoding = $encode;
    }

    public function getDatetime($paramName, $unixTime = false)
    {
        if(is_array($paramName)) {
            $params = $paramName;
        } else {
            $params = isset($this->$paramName) ? $this->$paramName : array();
        }

        return Ab_Utils_Date::getDatetime($params, $unixTime);
    }

    /**
     * 検索パラメータから除外するキー
     */
    protected $_ignoreSearchParams = array();

    /**
     * 検索パラメータから除外するキーをセット
     *
     * @param  mixed        $keys
     */
    public function setIgnoreSearchParams($keys)
    {
        $this->_ignoreSearchParams = is_array($keys) ? $keys : array($keys);
    }

    /**
     * 検索時に引き継ぐGETパラメータを取得
     */
    public function getSearchParams()
    {
        $ignore = array_flip($this->_ignoreSearchParams);
        $params = array_diff_key($this->getParams(), $ignore);

        $default = array_flip(array('controller', 'action', 'module', 'page', 'PHPSESSID'));
        $params = array_diff_key($params, $default);

        return http_build_query($params, '', '&');
    }

    public function __get($key)
    {
        $param = null;

        if(preg_match("/^([^\\[]+)\\[([^\\]]+)\\]$/", $key, $match)) {
            $key = $match[1];
            $param = $match[2];
        }

        $isConvertEncoding = false;
        switch (true) {
            case isset($this->_params[$key]):
                $value = $this->_params[$key];
                break;
            case isset($_GET[$key]):
                $value = $_GET[$key];
                $isConvertEncoding = true;
                break;
            case isset($_POST[$key]):
                $value = $_POST[$key];
                $isConvertEncoding = true;
                break;
            case isset($_COOKIE[$key]):
                $value = $_COOKIE[$key];
                break;
            case ($key == 'REQUEST_URI'):
                $value = $this->getRequestUri();
                break;
            case ($key == 'PATH_INFO'):
                $value = $this->getPathInfo();
                break;
            case isset($_SERVER[$key]):
                $value = $_SERVER[$key];
                break;
            case isset($_ENV[$key]):
                $value = $_ENV[$key];
                break;
            default:
                $value = null;
        }

        if(null !== $param) {
            $value = is_array($value) && isset($value[$param]) ? $value[$param] : null;
        }

        if($isConvertEncoding && $this->_inputEncoding !== null) {
            $value = Ab_Utils_String::convertEncoding($value, 'UTF-8', $this->_inputEncoding);
        }

        return $value;
    }

    /**
     * Retrieve a parameter
     *
     * Retrieves a parameter from the instance. Priority is in the order of
     * userland parameters (see {@link setParam()}), $_GET, $_POST. If a
     * parameter matching the $key is not found, null is returned.
     *
     * If the $key is an alias, the actual key aliased will be used.
     *
     * @param mixed $key
     * @param mixed $default Default value to use if key not found
     * @return mixed
     */
    public function getParam($key, $default = null)
    {
        $keyName = (null !== ($alias = $this->getAlias($key))) ? $alias : $key;

        $paramSources = $this->getParamSources();
        if (isset($this->_params[$keyName])) {
            return $this->_params[$keyName];
        } elseif (in_array('_GET', $paramSources) && (isset($_GET[$keyName]))) {
            $value = $_GET[$keyName];
            if($this->_inputEncoding !== null) {
                $value = Ab_Utils_String::convertEncoding($value, 'UTF-8', $this->_inputEncoding);
            }
            return $value;
        } elseif (in_array('_POST', $paramSources) && (isset($_POST[$keyName]))) {
            $value = $_POST[$keyName];
            if($this->_inputEncoding !== null) {
                $value = Ab_Utils_String::convertEncoding($value, 'UTF-8', $this->_inputEncoding);
            }
            return $value;
        }

        return $default;
    }

    /**
     * Retrieve an array of parameters
     *
     * Retrieves a merged array of parameters, with precedence of userland
     * params (see {@link setParam()}), $_GET, $_POST (i.e., values in the
     * userland params will take precedence over all others).
     *
     * @return array
     */
    public function getParams()
    {
        $return       = $this->_params;
        $paramSources = $this->getParamSources();

        if (in_array('_GET', $paramSources) && isset($_GET) && is_array($_GET)) {
            $get = $_GET;
            if($this->_inputEncoding !== null) {
                $get = Ab_Utils_String::convertEncoding($get, 'UTF-8', $this->_inputEncoding);
            }
            $return += $get;
        }
        if (in_array('_POST', $paramSources) && isset($_POST) && is_array($_POST)) {
            $post = $_POST;
            if($this->_inputEncoding !== null) {
                $post = Ab_Utils_String::convertEncoding($post, 'UTF-8', $this->_inputEncoding);
            }
            $return += $post;
        }

        return $return;
    }
}

