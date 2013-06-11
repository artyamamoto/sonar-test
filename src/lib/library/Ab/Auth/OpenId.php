<?php

/**
 * OpenID認証処理
 */
class Ab_Auth_OpenId
{
    protected $_config = null;

    protected $_nonce = null;

    public function __construct()
    {
        // Config取得
        $this->_config = Zend_Registry::getInstance()->config->openid;
    }

    /**
     * OpenID認証
     *
     * @return  string          リダイレクトURL
     */
    public function auth($realm, $url, $resultUrl)
    {
        $consumer = $this->_getOpenIdConsumer();

        $auth_request = $consumer->begin($url);
        if(!$auth_request) {
            throw new Exception('OpenID failure.');
        }

        // リダイレクト先 URL 
        $redirectUrl = $auth_request->redirectURL($realm, $resultUrl);

        if (Auth_OpenID::isFailure($redirectUrl)) {
            throw new Exception('OpenID failure.');
        }

        return $redirectUrl;
    }

    /**
     * 認証結果処理
     *
     * @return  string              中間ID
     */
    public function result($resultUrl)
    {
        $consumer = $this->_getOpenIdConsumer();

        // Return_to をセットして、認証を完了(OP-Identifier による認証時の再 Discovery 等)
        $response = $consumer->complete($resultUrl);

        if($response->status == Auth_OpenID_CANCEL) {
            throw new Exception('Auth openID is canceled.(' . $response->message . ')');
        } else if($response->status == Auth_OpenID_FAILURE) {
            throw new Exception('Auth openID is failed.(' . $response->message . ')');
        } else if($response->status != Auth_OpenID_SUCCESS) {
            throw new Exception('Auth openID is unknown error.(' . $response->message . ')');
        }

        $args = $response->message->toPostArgs();
        $this->_nonce = $args['openid.response_nonce'];

        // 認証成功。ユーザの OpenID を取得
        return $response->getDisplayIdentifier();
    }

    public function getNonce()
    {
        return $this->_nonce;
    }

    /**
     * PHP OpenIdConsumerを取得
     *
     * @return Auth_OpenID_Consumer
     */
    protected function _getOpenIdConsumer()
    {
        $dsn = array(
            'phptype'  => Jw::getConfig()->database->idc_master->type,
            'username' => Jw::getConfig()->database->idc_master->username,
            'password' => Jw::getConfig()->database->idc_master->password,
            'hostspec' => Jw::getConfig()->database->idc_master->host,
            'database' => Jw::getConfig()->database->idc_master->name,
        );
        $options = array(
            'persistent'  => true,
            'portability' => 'DB_PORTABILITY_ALL',
        );
        $db = DB::connect($dsn, $options);
        if(!$db) {
            throw new Exception('OpenID failure.');
        }

        $associationsTable = $this->_config->table->associations;
        $noncesTable       = $this->_config->table->nonces;

        $store    = new Auth_OpenID_MySQLStore($db, $associationsTable, $noncesTable);
        $consumer = new Auth_OpenID_Consumer($store);

        return $consumer;
    }
}

