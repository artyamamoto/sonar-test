<?php

/**
 * ImgController
 */
class ImgController extends BaseController
{
    public function viewAction() 
    {
        $file = isset($this->_request->file) ? $this->_request->file : 'notfound';
        $file = preg_match("/[^0-9a-zA-Z_]/", $file) ? 'notfound' : $file;
        $dir = '../data/image/' . $file;

        list($filePath, $contentPathName) = Ab_Utils_Gae::getContentPath($dir, 'Logo');

        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        // チェック
        if(null == $filePath) {
            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $image = file_get_contents($filePath);
        $contentType = Ab_Utils_File::getContentType($image);

        $this->getResponse()->setHeader('Content-Length', strlen($image))
                            ->setHeader('Content-Type', $contentType)
                            ->setHeader('x-jphone-copyright', 'no-transfer')
                            ->setBody($image);
    }

    public function view2Action() 
    {
        $file = isset($this->_request->file) ? $this->_request->file : 'notfound';
        $file = preg_match("/[^0-9a-zA-Z_]/", $file) ? 'notfound' : $file;
        $dir = '../data/image/' . $file;

        $device = Ab_Device::getInstance();
        if($device->isDoCoMo()) {
            $filePath = $dir . '/docomo.jpg';
        } elseif($device->isEZweb()) {
            $filePath = $dir . '/au.jpg';
        } elseif($device->isSoftBank()) {
            $filePath = $dir . '/softbank.jpg';

            /*
            if(isset($_SERVER['HTTP_X_JPHONE_DISPLAY'])) {
                list($w, $h) = explode('*', $_SERVER['HTTP_X_JPHONE_DISPLAY'], 2);

                $filePath = $w > 400 ? $dir . '/240.jpz' : $dir . '/140.jpz';
            }
            */
        } elseif($device->isSmartphone()) {
            $filePath = $dir . '/sp.jpg';
        }

        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        // チェック
        if(null == $filePath) {
            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $image = file_get_contents($filePath);
        $contentType = Ab_Utils_File::getContentType($image);

        $this->getResponse()->setHeader('Content-Length', strlen($image))
                            ->setHeader('Content-Type', $contentType)
                            ->setHeader('x-jphone-copyright', 'no-transfer')
                            ->setBody($image);
    }
}

