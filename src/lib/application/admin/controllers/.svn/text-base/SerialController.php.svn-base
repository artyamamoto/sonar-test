<?php

/**
 * Serial controller
 */
class SerialController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'serial';

    /**
     * @var     string
     */
    protected $_uploadTmpName = null;

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_SETTING;

    public function getValidatorRules() {
        $rules = array(
            'name' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'code' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'file_name' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
        );

        return $rules;
    }

    protected function _preSave($row)
    {
        parent::_preSave($row);

        $this->_uploadTmpName = $this->_request->file_name['tmp_name'];
        $row->file_name = $this->_request->file_name['name'];
    }

    protected function _postSave($row)
    {
        $config = Zend_Registry::getInstance()->config;

        $fileName = $config->upload->dir . '/' . $this->_uploadTmpName;
        $fp = fopen($fileName, 'r');

        $table = new SerialNumberTable();

        $data = array();
        while(!feof($fp)) {
            $s = trim(fgets($fp));

            if(strlen($s) == 0) {
                continue;
            }

            $data[] = array(
                'serial_id' => $row->id,
                'n' => $s,
            );
            if(count($data) >= 100) {
                $table->insertMulti('serial_number', $data);
                $data = array();
            }
        }

        if(count($data) > 0) {
            $table->insertMulti('serial_number', $data);
            $data = array();
        }

        fclose($fp);
        unlink($fileName);

        parent::_postSave($row);
    }

    public function deleteAction()
    {
        $row = $this->_table->getRow(array('id' => $this->_request->id));

        $this->_request->setParams($row->toArray());
        $this->_request->setParam('file_name', array('name' => $row->file_name));

        $this->_helper->ViewRenderer->setRender('input');
    }

    protected function _preDelete($row)
    {
        parent::_preDelete($row);

        $table = new SerialNumberTable();
        $table->delete(array('serial_id = ?' => $row->id));

        $table = new SerialUseTable();
        $table->delete(array('code = ?' => $row->code));
    }
}

