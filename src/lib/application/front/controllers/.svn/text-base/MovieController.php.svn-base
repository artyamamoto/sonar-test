<?php

/**
 * movie controller
 */
class MovieController extends BaseController
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
        if(preg_match('/[^a-z]/', $this->_request->type) || preg_match('/[^a-z]/', $this->_request->kind)) {
            $this->_forward('index');
            return;
        }

        // シリアルチェック
        $table = new SerialUseTable();
        if(!$table->checkByUid($this->_uid, $this->_request->type)) {
            $this->_forward('index');
            return;
        }

        // 動画対応機種チェック
        if(Ab_Device::getInstance()->isMobile() && !Ab_Utils_Gae::getDeviceMaterial('LongMovie')) {
            $this->_forward('device_error');
            return;
        }
    }

    /**
     * 動画ダウンロード
     */
    public function downloadAction()
    {
        // DB接続はもう不要なのでクローズする
        Ab_Db_Table::getDefaultAdapter()->closeConnection();

        $materialId = null;

        $dir = Zend_Registry::getInstance()->config->movie->dir;
        $dir .= '/' . $this->_request->type . '_' . $this->_request->kind;

        $devices = Ab_Utils_Gae::getDeviceMaterial('LongMovie');
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
        $contentType = $this->_contentTypes[$materialId];

        $this->_download($filePath, $contentType);
    }
}

