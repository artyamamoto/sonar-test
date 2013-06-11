<?php

/**
 * Ab_Jfc class.
 */
class Ab_Jfc
{
    protected $_config;

    protected $_cookie = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_config = Zend_Registry::getInstance()->config->jfc;
    }

    /**
     * ログインチェック
     */
    public function loginCheck($fanDiv, $id, $password)
    {
        // post data.
        $data = array(
            'fun_div_1'   => $fanDiv,
            'customer_no' => $id,
            'pass'        => $password,
            'mode'        => 'login',
            'flg'         => '',
        );

        // header
        $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Referer: https://www.fc-member.johnnys-net.jp/login_jfc.html',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:9.0.1) Gecko/20100101 Firefox/9.0.1',
        );

        $client = new Zend_Http_Client($this->_config->login->url, array('maxredirects' => 0, 'timeout' => 30));
        $client->setParameterPost($data);
        $client->setHeaders($header);
        if($this->_config->login->auth->user) {
            $client->setAuth($this->_config->login->auth->user, $this->_config->login->auth->password);
        }
        $response = $client->request('POST');

        $location = $response->getHeader('Location');

        if(strpos($location, 'error_member.html') !== false) {
            return false;
        }

        // Cookieデータをパース
        $cookies = $response->getHeader('Set-cookie');
        foreach($cookies as $cookie) {
            list($val, $dummy) = explode(';', $cookie, 2);
            list($k, $v) = explode('=', $val, 2);

            if(!$v || $v == 'deleted') {
                continue;
            }

            $this->_cookie[$k] = urldecode($v);
        }

        return true;
    }

    /**
     * 指定のURLへリクエスト
     */
    public function request($url)
    {
        $url = Ab_Utils_Uri::normary($url);

        // header
        $header = array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:9.0.1) Gecko/20100101 Firefox/9.0.1',
        );

        $client = new Zend_Http_Client($url, array('maxredirects' => 0, 'timeout' => 30));
        $client->setHeaders($header);
        foreach($this->_cookie as $k => $v) {
            $client->setCookie($k, $v);
        }
        if($this->_config->login->auth->user) {
            $client->setAuth($this->_config->login->auth->user, $this->_config->login->auth->password);
        }
        $response = $client->request('GET');

        if($response->isError()) {
            return false;
        }

        return $response->getBody();
    }

    /**
     * Cookieのクリア
     */
    public function clearCookie()
    {
        $this->_cookie = array();
    }
}

