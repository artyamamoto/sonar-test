<?php

/**
 * Base controller
 */
class BaseController extends Ab_Controller_Action 
{
    protected $_session = null;

    /**
     * @var boolean
     */
    protected $_checkLogin = false;

    /**
     * @var string
     */
    protected $_uid = null;

    /**
     * @var string
     */
    protected $_domain = null;

    /**
     * @var string
     */
    protected $_campaign = null;

    public function init()
    {
        parent::init();
        $config = Zend_Registry::getInstance()->config;

        Zend_Session::setOptions(array('use_only_cookies' => 'off'));
        $this->_session = new Zend_Session_Namespace('Default');

        // DoCoMoのURLにguid=ONを付加
        if(Ab_Device::getInstance()->isDoCoMo()) {
            output_add_rewrite_var('guid', 'ON');
            ini_set("url_rewriter.tags", "a=href,area=href,img=src,frame=src,form=action,fieldset=");
        }

        /*
        // スマートフォンのu、vの引き継ぎ
        if(Ab_Device::getInstance()->isSmartphone() && strlen($this->_request->u) > 0) {
            output_add_rewrite_var('u', $this->_request->u);
            output_add_rewrite_var('v', $this->_request->v);
        }
        */

        // Uidチェック
        $this->_checkUid();
        if(strlen($this->_uid) > 0) {
            $this->_request->setParam('uid', $this->_uid);
        }

        // ドメインチェック
        $this->_checkDomain();
    }

    public function postDispatch()
    {
        $this->view->device = Ab_Device::getInstance();
        $this->view->base_url = $this->_request->getBaseUrl();

        $this->view->uid = $this->_uid;
        $this->view->domain = $this->_domain;
        $this->view->campaign = $this->_campaign;

        parent::postDispatch();
    }

    /**
     * UID、アプリバージョンのチェック
     */
    protected function _checkUid()
    {
        $device = Ab_Device::getInstance();

        if($device->isMobile()) {
            // 携帯の場合
            if(strlen($device->getUid()) > 0) {
                $this->_uid = $device->getUid();
                return true;
            }

            // 携帯&SSL
            if($_SERVER['HTTPS']=='on' && isset($this->_request->u) && strlen($this->_request->u) > 0) {
                $this->_uid = $this->_request->u;
                return true;
            }

            return false;
        } else {
            // スマートフォンの場合

            /*
            // アプリのバージョン・UIDチェック
            if(isset($this->_request->v) && strlen($this->_request->v) > 0) {
                if(isset($this->_request->u) && strlen($this->_request->u) > 0 && $this->_request->u != 'None'
                   && $this->_request->v >= 1.3) {
                    $this->_uid = $this->_request->u;
                    return true;
                }

                // アプリのバージョン・UIDが取得できない場合はエラーページを表示
                $this->redirector->gotoAndExit('device', 'error');
            }
            return false;
            */

            // CookieからUIDを取得
            if(isset($_COOKIE['uid']) && strlen($_COOKIE['uid']) > 0) {
                $this->_uid = $_COOKIE['uid'];
                return true;
            }

            // SSL
            if($_SERVER['HTTPS']=='on' && isset($this->_request->u) && strlen($this->_request->u) > 0) {
                $this->_uid = $this->_request->u;
                $timeout = time() + 60 * 86400;
                //setcookie("uid", $this->_uid, $timeout, '/', $_SERVER['SERVER_NAME']);

                return true;
            }

            // 存在しない場合は生成
            $this->_uid = md5($device->getUserAgent() . time() . $_SERVER['REMOTE_ADDR']);
            $timeout = time() + 60 * 86400;
            //setcookie("uid", $this->_uid, $timeout, '/', $_SERVER['SERVER_NAME']);

            return true;
        }
    }

    /**
     * ドメインのチェック
     */
    protected function _checkDomain()
    {
        if($_SERVER['HTTPS']=='on') {
            $tmp = explode('/', $_SERVER['REQUEST_URI']);
            $domain = $tmp[1];
            $campaign = $tmp[2];

            $domain .= strpos($domain, 'je-cp') !== false ? '.com' : '.jp';
        } else {
            $domain = $_SERVER['SERVER_NAME'];

            $tmp = explode('/', $_SERVER['REQUEST_URI']);
            $campaign = $tmp[1];
        }

        // ステージング対応
        $domain = str_replace('stage.', '', $domain);
        $domain = str_replace('stage-', '', $domain);

        $this->_domain = $domain;
        $this->_campaign = $campaign;
    }

    /**
     * 対応機種一覧
     */
    public function getSupportDevice()
    {
        $carrier = Ab_Utils_Gae::getCarrierId();

        $url = 'http://www.johnnys-web.com/?id=deviceListJson&carrier_id=' . $carrier . '&type=LongMovie&uid=01ABDUMMY001';

        $header = array(
            'User-Agent: DoCoMo/2.0 P903i(c100;TB;W24H12)',
        );

        $context = array(
            "http" => array(
                "method"  => "GET",
                "header"  => implode("\r\n", $header),
            )
        );

        $content = file_get_contents($url , false, stream_context_create($context));

        return json_decode($content);
    }

    /**
     * ダウンロード処理
     *
     * Range処理を考慮して、バイナリデータのダウンロードを行う
     *
     * @param   string  $filePath       ダウンロードファイルパス
     * @param   string  $contentType    Content-type
     */
    protected function _download($filePath, $contentType)
    {
        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        // チェック
        if(null == $filePath) {
            $this->_logger->warn('Download contents not found.(' . $filePath . ')');
            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $content = file_get_contents($filePath);

        // Rangeリクエスト対応
        $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : '';
        if(preg_match('/^bytes=(\d+)\-(\d+)$/i', $range, $matches)) {
            $offset = $matches[1];
            $end = $matches[2];
            $len = $end - $offset + 1;

            $contentRange = sprintf("bytes %d-%d/%d", $offset, $end, strlen($content));

            $this->getResponse()->setHttpResponseCode(206)
                                ->setHeader('Accept-Ranges', 'bytes')
                                ->setHeader('Content-Range', $contentRange)
                                ->setHeader('Last-Modified', gmdate('D, d M Y H:i:s \G\M\T'));
            $content = substr($content, $offset, $len);
        }

        $this->getResponse()->setHeader('Content-Type', $contentType);

        if(Ab_Device::getInstance()->isSoftBank()) {
            $this->getResponse()->setHeader('x-jphone-copyright', 'no-transfer')
                                ->setHeader('Cache-Control', 'private', true)
                                ->setHeader('Pragma', 'private', true);
        }

        $this->getResponse()->setHeader('Content-Length', strlen($content))
                            ->setBody($content);

        $content = null;
    }
}

