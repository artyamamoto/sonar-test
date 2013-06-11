<?php

/**
 * wallpaper controller
 */
class WallpaperController extends BaseController
{
    public function preDispatch()
    {
        parent::preDispatch();

        // UIDチェック
        if(strlen($this->_uid) == 0) {
            $this->_forward('index', 'index');
            return;
        }

        // 入力チェック
        if(preg_match('/[^a-z0-9_]/', $this->_request->name)) {
            $this->_forward('index', 'index');
            return;
        }

        // ダウンロードチェック
        if(!SerialUseTable::checkByUid($this->_uid, 'a', 'a', $this->_request->hash)) {
            $this->_forward('index', 'index');
            return;
        }
    }

    /**
     * 待受ダウンロード
     */
    public function downloadAction()
    {
        // DB接続はもう不要なのでクローズする
        Ab_Db_Table::getDefaultAdapter()->closeConnection();

        $dir = '../data/wallpaper/' . $this->_request->name;

        if(Ab_Device::getInstance()->isMobile()) {
            list($filePath, $contentPathName) = Ab_Utils_Gae::getContentPath($dir, 'Image');
        } else {
            $filePath = $dir . '/sp.jpg';
        }

        // チェック
        if(null == $filePath) {
            $this->_helper->ViewRenderer->setNoRender();
            Ab_Layout::getMvcInstance()->disableLayout();

            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $image = file_get_contents($filePath);
        $contentType = Ab_Utils_File::getContentType($image);

        if(Ab_Device::getInstance()->isMobile()) {
            if(Ab_Device::getInstance()->isEzweb()) {
                $this->_downloadAu($image, $contentType);
            } else {
                $this->_download($image, $contentType);
            }
        } else {
            $this->_downloadSmartphone($filePath, $contentType);
        }
    }

    /**
     * 待ち受けダウンロード（Smartphone）
     */
    protected function _downloadSmartphone($filePath, $contentType)
    {
        // メールアドレス取得
        $mailTable = new MailTable();
        $mail = $mailTable->checkHash($this->_request->hash);
        if(!$mail) {
            $this->_helper->redirector->gotoAndExit('index', 'index');
            return;
        }

        // フォント設定
        $text = $mail->mail;
        $fontPath = Zend_Registry::getInstance()->config->font->artbank;
        $fontSize = 30;

        // 画像をロード
        $image = imagecreatefromjpeg($filePath);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        // boundary box取得
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $text);
        $bottomLeftY = $bbox[1];
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7];

        // キャンバスのサイズ
        $canvasWidth = $imageWidth;
        $canvasHeight = $imageHeight + $textHeight;

        // キャンバス作成・背景色設定
        $canvas = imagecreatetruecolor($canvasWidth, $canvasHeight);
        $bgColor = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $bgColor);

        // キャンバスへ画像をコピー
        imagecopy($canvas, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));

        // フォントカラー設定
        $fontColor = imagecolorallocate($canvas, 0, 0, 0);

        // キャンバスへフォントを描画
        imagettftext($canvas, $fontSize, 0, ($canvasWidth - $textWidth) / 2, $imageHeight + $margin + $textHeight - $bottomLeftY, $fontColor, $fontPath, $text);

        ob_end_clean();
        ob_start();
        imagejpeg($canvas);
        $data = ob_get_clean();

        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        $this->getResponse()->setHeader('Content-Type', $contentType)
                            ->setHeader('Cache-Control', 'private')
                            ->setBody($data);
    }

    /**
     * 待ち受けダウンロード（docomo,Softbank）
     */
    protected function _download($image, $contentType)
    {
        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        $this->getResponse()->setHeader('Content-Type', $contentType)
                            ->setHeader('Cache-Control', 'private')
                            ->setHeader('x-jphone-copyright', 'no-transfer')
                            ->setHeader('x-jphone-copyright', 'no-peripheral')
                            ->setBody($image);
    }

    /**
     * 待ち受けダウンロード（au）
     */
    protected function _downloadAu($image, $contentType)
    {
        $offset = isset($this->_request->offset) ? $this->_request->offset : 0;
        $count  = isset($this->_request->count) ? $this->_request->count : 0;

        if($offset >= 0 && $count > 0) {
            $this->_helper->ViewRenderer->setNoRender();
            Ab_Layout::getMvcInstance()->disableLayout();

            $this->getResponse()->setHeader('Content-Type', 'application/x-up-download')
                                ->setHeader('Content-Length', $count)
                                ->setBody(substr($image, $offset, $count));
        }
    }
}

