<?php

/**
 * uta controller
 */
class UtaController extends BaseController
{
    public function preDispatch()
    {
        parent::preDispatch();

        // UIDチェック
        if(strlen($this->_uid) == 0) {
            $this->_forward('device_error');
            return;
        }

        // 入力チェック
        if(preg_match('/[^a-z_]/', $this->_request->file)) {
            $this->_forward('index', 'index');
            return;
        }

        if($this->_request->file == 'jicchan') {
            $target = 1;
        } elseif($this->_request->file == 'nazoha') {
            $target = 2;
        } else {
            $target = 3;
        }

        // シリアルチェック
        $table = new SerialUseTable();
        if(Ab_Device::getInstance()->isMobile() && !SerialUseTable::checkByUid($this->_uid, 'b', $target)) {
            $this->_forward('index', 'index');
            return;
        }

        // 着うた対応機種チェック
        if(Ab_Device::getInstance()->isMobile() && !Ab_Utils_Gae::getDeviceMaterial('Uta')) {
            $this->_forward('device_error', 'index');
            return;
        }
    }

    /**
     * 着うたダウンロード
     */
    public function downloadAction()
    {
        // DB接続はもう不要なのでクローズする
        Ab_Db_Table::getDefaultAdapter()->closeConnection();

        if(Ab_Device::getInstance()->isMobile()) {
            $materialId = null;

            $dir = Zend_Registry::getInstance()->config->uta->dir;
            $dir .= '/' . $this->_request->file;

            $devices = Ab_Utils_Gae::getDeviceMaterial('Uta');
            foreach($devices as $device) {
                $id = $device['id'];

                if(file_exists($dir . '/' . $id)) {
                    $materialId = $id;
                    break;
                }
            }

            if($materialId == null) {
                $this->_helper->redirector('device_error', 'page');
                return;
            }

            $filePath = $dir . '/' . $materialId;
            $contentType = Ab_Utils_Gae::getContentType($materialId);
        } else {
            $dir = Zend_Registry::getInstance()->config->uta->dir;
            $filePath = $dir . '/' . $this->_request->file . '/' . 'sp.mp3';

            $contentType = 'audio/mpeg';
        }

        $this->_download($filePath, $contentType);
    }
}

