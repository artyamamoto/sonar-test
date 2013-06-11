<?php

/**
 * Base controller
 */
class BaseController extends Ab_Controller_Action 
{
    /**
     * @var     string
     */
    protected $_tableName = null;

    /**
     * @var     Ab_Db_Table
     */
    protected $_table = null;

    /**
     * @var string
     */
    protected $_menuTemplate = 'menu.tpl';

    /**
     * @var Ab_Controller_Request_File
     */
    protected $_file;

    /**
     * @var int     必要なロール
     */
    protected $_role = null;

    public function init()
    {
        parent::init();

        $config = Zend_Registry::getInstance()->config;

        $this->_file = new Ab_Controller_Request_File($this->_request);
        $this->_file->setTempDirectory($config->upload->dir);
        $this->_file->saveFiles();

        // 管理者情報をDBから再取得、セッションIDのチェック
        if($this->_checkLogin && $this->_administrator) {
            $where = array(
                'id = ?' => $this->_administrator->id,
                'mail_address = ?' => $this->_administrator->mail_address,
                'valid_flag = 1',
            );
            $administratorTable = new AdministratorTable();
            $this->_administrator = $administratorTable->fetchRow($where);

            if(!$this->_administrator || session_id() != $this->_administrator->session_id) {
                $this->redirector->gotoAndExit('index', 'login');
            }
        }
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if(null !== $this->_tableName) {
            $className    = Ab_Utils_String::camelize($this->_tableName) . 'Table';
            $this->_table = new $className();
        }

        // ROLEチェック
        if($this->_role && !($this->_administrator->role & $this->_role)) {
            $this->_forward('role', 'error');
        }
    }

    public function postDispatch()
    {
        if(is_null($this->_leftMenuTemplate)) {
            $action = $this->_request->getActionName();
            if($action == 'search' || (isset($this->_request->id) && $this->_request->id)) {
                $this->_leftMenuSelected = 'search';
            } else {
                $this->_leftMenuSelected = 'new';
            }
        }

        $this->view->session_id = session_id();

        $this->view->table = $this->_table;

        parent::postDispatch();
    }

    public function searchAction()
    {
        $this->paginate($this->_table);

        $this->view->searchParams = $this->_getSearchParams();
    }

    protected function _getSearchParams()
    {
        if(!isset($this->_request->search) || !is_array($this->_request->search)) {
            return null;
        }

        return http_build_query(array('search' => $this->_request->search));
    }

    public function newAction() 
    {
        $this->_request->setParam('valid_flag', 1);

        // 公開日時 5日後の12時をデフォルト
        $t = time() + 86400 * 5;
        $releaseDate = array(
            'year' => date('Y', $t),
            'month' => date('m', $t),
            'day' => date('d', $t),
            'hour' => 12,
            'minute' => 0,
        );
        $this->_request->setParam('release_date', $releaseDate);

        $this->_forward('input');
    }

    public function editAction() 
    {
        $row = $this->_table->getRow(array('id' => $this->_request->id));

        $this->_request->setParams($row->toArray());
        $this->_forward('input');
    }

    public function detailAction() 
    {
        $row = $this->_table->getRow(array('id' => $this->_request->id));

        $this->_request->setParams($row->toArray());
        $this->_helper->ViewRenderer->setRender('input');
    }

    public function deleteAction() 
    {
        $row = $this->_table->getRow(array('id' => $this->_request->id));

        $this->_request->setParams($row->toArray());
        $this->_helper->ViewRenderer->setRender('input');
    }

    public function inputAction() 
    {
    }

    public function confirmAction() 
    {
        // 画像のアップロード
        if(strlen($this->_request->upload) > 0) {
            $this->_upload();
            $this->_forward('input');
            return;
        }

        $this->validate();

        $this->_postValidate();

        $this->_helper->ViewRenderer->setRender('input');
    }

    protected function _postValidate()
    {
    }

    public function _upload()
    {
        $name = $this->_request->upload;
        $value = $this->_request->{$name};

        $image = $this->_request->getParam('image_' . $name);
        if(!isset($image['tmp_name']) || strlen($image['tmp_name']) == 0) {
            return;
        }

        $value .= '<img src="/upload/view/name/' . $image['tmp_name'] . '" />';
        $this->_request->setParam($name, $value);
    }

    public function completeAction() 
    {
        if(strlen($this->_request->back) > 0) {
            $this->_forward('input');
            return;
        } elseif(strlen($this->_request->search) > 0) {
            $this->_forward('search');
            return;
        }

        if(is_null($this->_request->delete) && !$this->validate()){
            return;
        }

        $row = $this->_table->getRow($this->_request->getParams());
        if(!is_null($this->_request->delete) ){
            $this->_preDelete($row);
            $row->delete();
            $this->_postDelete($row);

            $this->_forward('search');
            return;
        }

        // 編集した管理者IDの保存
        $meta = $this->_table->info(Ab_Db_Table::METADATA);
        if(isset($meta['administrator_id'])) {
            $row->administrator_id = $this->_administrator->id;
        }

        // 公開
        if(strlen($this->_request->release) > 0) {
            $row->setReleaseStatus();
        } else {
            $row->setEditStatus();
        }

        $this->_preSave($row);
        $id = $row->save();
        $this->_postSave($row);

        $this->_request->setParam('id', $id);
        $this->_helper->ViewRenderer->setRender('input');
    }

    /**
     * アップロードファイルの表示
     */
    public function viewAction()
    {
        $config = Zend_Registry::getInstance()->config;

        $fileName = $this->_request->name;
        $fileName = $config->upload->dir . '/' . $fileName;

        $this->_helper->ViewRenderer->setNoRender();
        Ab_Layout::getMvcInstance()->disableLayout();

        if(!file_exists($fileName) || ereg("[^0-9a-zA-Z\\.]", $this->_request->name)) {
            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $this->getResponse()->setHeader('Content-type', 'image/jpeg')
                            ->setBody(file_get_contents($fileName));
    }

    protected function _preSave($row)
    {
    }

    protected function _postSave($row)
    {
    }

    protected function _preDelete($row)
    {
    }

    protected function _postDelete($row)
    {
    }

    public function getValidatorRules()
    {
        return array();
    }

    protected function _setPaginateCondition($select)
    {
        parent::_setPaginateCondition($select);

        $search = $this->_request->search;
        if(!is_array($search)) {
            return;
        }

        $db = $select->getAdapter();

        foreach($search as $key => $val) {
            if(!$this->_table->hasColumn($key)) {
                continue;
            }
            if(strlen($val) <= 0) {
                continue;
            }

            $dataType = $this->_table->getDataType($key);

            $key = $db->quoteIdentifier($key);

            if($dataType == 'varchar' || $dataType == 'text') {
                $select->where($db->quoteInto($key . ' LIKE ?', '%' . $val . '%'));
            } else {
                $select->where($db->quoteInto($key . ' = ?', $val));
            }
        }
    }

}

