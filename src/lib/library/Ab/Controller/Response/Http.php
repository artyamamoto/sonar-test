<?php

class Ab_Controller_Response_Http extends Zend_Controller_Response_Http
{
    protected $_outputEncoding = null;

    public function setOutputEncoding($encode)
    {
        $this->_outputEncoding = $encode;
    }

    /**
     * Set redirect URL
     *
     * Sets Location header and response code. Forces replacement of any prior
     * redirects.
     *
     * @param string $url
     * @param int $code
     * @return Zend_Controller_Response_Abstract
     */
    public function setRedirect($url, $code = 302)
    {
        $this->canSendHeaders(true);

        // SESSIONIDを付与
        if(Ab_Device::getInstance()->isMobile()) {
            $url .= strpos($url, '?') === FALSE ? '?' : '&';
            $url .= session_name() . '=' . session_id();
        }

        $this->setHeader('Location', $url, true)
             ->setHttpResponseCode($code);

        return $this;
    }

    /**
     * Send the response, including all headers, rendering exceptions if so
     * requested.
     *
     * @return void
     */
    public function sendResponse()
    {
        $find = false;
        foreach($this->_headers as $header) {
            if($header['name'] == 'Content-Type') {
                $find = true;
            }
        }
        if(!$find) {
            $config = Zend_Registry::getInstance()->config;
            $contentType = $config->page->content->type->{Ab_Device::getInstance()->getTypeString()};

            $this->setHeader('Content-Type', $contentType);
        }

        parent::sendResponse();
    }

    /**
     * Echo the body segments
     *
     * @return void
     */
    public function outputBody()
    {
        $body = implode('', $this->_body);

        // テキスト判定
        $isText = false;
        foreach($this->_headers as $header) {
            if($header['name'] == 'Content-Type' && strpos($header['value'], 'text/') === 0) {
                $isText = true;
            }
        }

        // 文字コード変換
        if($isText && null !== $this->_outputEncoding) {
            if($this->_outputEncoding == 'SJIS' || $this->_outputEncoding == 'CP932') {
                $body = str_replace('text/html; charset=UTF-8', 'text/html; charset=Shift_JIS', $body);
            }

            $body = mb_convert_encoding($body, $this->_outputEncoding, 'UTF-8');
        }

        echo $body;
    }
}

