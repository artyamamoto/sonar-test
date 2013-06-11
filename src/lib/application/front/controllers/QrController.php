<?php

class QrController extends BaseController
{
    public function viewAction() 
    {
        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        if(!$this->_checkUid()) {
            exit();
        }

        $table =  new MemberTable();
        $row = $table->fetchRow(array('uid = ?' => $this->_uid));
        if(!$row) {
            exit();
        }


        if(Ab_Device::getInstance()->isSmartphone()) {
            $moduleSize = 8;
        } elseif(Ab_Device::getInstance()->isSoftBank() && isset($_SERVER['HTTP_X_JPHONE_DISPLAY'])) {
            list($w, $h) = explode('*', $_SERVER['HTTP_X_JPHONE_DISPLAY'], 2);
            $moduleSize = $w > 400 ? 12 : 6;
        } else {
            $moduleSize = 6;
        }

        $options = array(
            'output_type' => 'return',
            'image_type' => 'jpeg',
            'module_size' => $moduleSize,
        );

        $hash = md5($this->_uid);

        $qrcode = new Image_QRCode();
        $image = $qrcode->makeCode($hash, $options);

        if(Ab_Device::getInstance()->isDoCoMo()) {
            header('Content-type: image/gif');
            imagegif($image);
        } else {
            header('Content-type: image/png');
            imagepng($image);
        }
        exit();
    }
}

