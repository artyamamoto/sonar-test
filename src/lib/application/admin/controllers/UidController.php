<?php

/**
 * Uid controller
 */
class UidController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'uid';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_APPLICANT;

    public function getValidatorRules() {
        $rules = array(
            'file_name' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
        );

        return $rules;
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

        $separator = $this->_request->separator == 'tab' ? "\t" : ',';

        $config = Zend_Registry::getInstance()->config;

        // アップロードされたファイルを取得
        $uploadTmpName = $this->_request->file_name['tmp_name'];

        $fileName = $config->upload->dir . '/' . $uploadTmpName;
        $fp = fopen($fileName, 'r');

        $data = array();
        while(!feof($fp)) {
            $tmp = explode($separator, trim(fgets($fp)));

            if($tmp[0] == '' && $tmp[1] == '') {
                continue;
            }

            $data[] = array(
                'mail_address' => trim($tmp[0], '"'),
                //'course' => trim($tmp[1], '"'),
                'name1' => trim($tmp[1], '"'),
                'name2' => trim($tmp[2], '"'),
                'kname1' => trim($tmp[3], '"'),
                'kname2' => trim($tmp[4], '"'),
                //'postcode' => trim($tmp[6], '"'),
                'prefecture' => trim($tmp[5], '"'),
                //'address1' => trim($tmp[8], '"'),
                //'address2' => trim($tmp[9], '"'),
                'tel' => trim($tmp[6], '"'),
                /**
                'pair' => (trim($tmp[13], '"') != '' ? 1 : 0),
                'pair_name1' => trim($tmp[13], '"'),
                'pair_name2' => trim($tmp[14], '"'),
                'pair_kname1' => trim($tmp[15], '"'),
                'pair_kname2' => trim($tmp[16], '"'),
                'pair_postcode' => trim($tmp[17], '"'),
                'pair_prefecture' => trim($tmp[18], '"'),
                'pair_address1' => trim($tmp[19], '"'),
                'pair_address2' => trim($tmp[20], '"'),
                'pair_age' => trim($tmp[21], '"'),
                'pair_sex' => trim($tmp[22], '"'),
                'pair_tel' => trim($tmp[23], '"'),
                'serial1' => trim($tmp[24], '"'),
                'serial2' => trim($tmp[25], '"'),
                **/
                'is_uid_changed' => 0,
                'uid' => trim($tmp[9], '"'),
                'default_uid' => trim($tmp[9], '"'),
                'hash' => trim($tmp[8], '"'),
                'is_checked' => 0,
                'create_date' => new Zend_Db_Expr('NOW()'),
            );
            if(count($data) >= 10) {
                $this->_table->insertMulti('uid', $data);
                $data = array();
            }
        }

        if(count($data) > 0) {
            $this->_table->insertMulti('uid', $data);
            $data = array();
        }

        fclose($fp);
        unlink($fileName);


        $this->_request->setParam('id', $id);
        $this->_helper->ViewRenderer->setRender('input');
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

