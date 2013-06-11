<?php

/**
 * Ab_Db_Table_Row class.
 */
class Ab_Db_Table_Row extends Zend_Db_Table_Row_Abstract
{
    /**
     * Pre insert.
     *
     * @access protected
     */
    protected function _insert()
    {
        if(array_key_exists('create_date', $this->_data) && is_null($this->create_date)) {
            $this->create_date = new Zend_Db_Expr('NOW()');
        }
    }

    /**
     * Pre update.
     *
     * @access protected
     */
    protected function _update()
    {
        if(array_key_exists('update_date', $this->_data)) {
            $this->update_date = new Zend_Db_Expr('NOW()');
        }
    }

    /**
     * Sets all data in the row from an array.
     *
     * @param  array $data
     * @return Zend_Db_Table_Row_Abstract Provides a fluent interface
     */
    public function setFromArray(array $data)
    {
        $forms = $this->_table->getForms();

        foreach($forms as $key => $form) {
            if(!isset($data[$key])) {
                continue;
            }

            switch($form['type']) {
                case 'file':
                    if(is_array($data[$key]) && isset($data[$key]['tmp_name'])) {
                        $data[$key] = $data[$key]['tmp_name'];
                    }
                    break;
                case 'date':
                    if(is_array($data[$key])) {
                        $data[$key] = Ab_Utils_Date::getDatetime($data[$key]);
                    }
                    break;
                case 'datetime':
                    if(is_array($data[$key])) {
                        $data[$key] = Ab_Utils_Date::getDatetime($data[$key]);
                    }
                    break;
                case 'role':
                    if(is_array($data[$key])) {
                        $data[$key] = array_sum($data[$key]);
                    }
                    break;
                default:
            }
        }

        return parent::setFromArray($data);
    }

    /**
     * Release data.
     */
    public function release(Ab_Db_Table $releaseTable)
    {
        if($this->release_status == Ab_Db_Table::RELEASE_CREATE_WAIT || $this->release_status == Ab_Db_Table::RELEASE_UPDATE_WAIT) {
            // 新規公開、更新公開
            $row = $releaseTable->getRow($this->toArray());
            $row->save();

            $this->release_status = Ab_Db_Table::RELEASE_OPEN;
            $this->save();
        } elseif($this->release_status == self::RELEASE_DELETE_WAIT) {
            // 削除
            $row = $releaseTable->getRow($this->toArray());
            $row->delete();

            $this->delete();
        }
    }

    /**
     * リリースステータスを変更
     */
    public function setReleaseStatus()
    {
        if(!array_key_exists('release_status', $this->_data)) {
            return;
        }

        switch($this->release_status) {
            case Ab_Db_Table::RELEASE_CREATE_CHECK:
                $this->release_status = Ab_Db_Table::RELEASE_CREATE_WAIT;
                break;

            case Ab_Db_Table::RELEASE_UPDATE_CHECK:
                $this->release_status = Ab_Db_Table::RELEASE_UPDATE_WAIT;
                break;

            case Ab_Db_Table::RELEASE_DELETE_CHECK:
                $this->release_status = Ab_Db_Table::RELEASE_DELETE_WAIT;
                break;

            default:
        }
    }

    /**
     * リリースステータスを編集状態に変更
     */
    public function setEditStatus()
    {
        if(!array_key_exists('release_status', $this->_data)) {
            return;
        }

        switch($this->release_status) {
            case Ab_Db_Table::RELEASE_CREATE_WAIT:
                $this->release_status = Ab_Db_Table::RELEASE_CREATE_CHECK;
                break;

            case Ab_Db_Table::RELEASE_UPDATE_WAIT:
            case Ab_Db_Table::RELEASE_UPDATE_CHECK:
            case Ab_Db_Table::RELEASE_DELETE_CHECK:
            case Ab_Db_Table::RELEASE_OPEN:
                $this->release_status = Ab_Db_Table::RELEASE_UPDATE_CHECK;
                break;

            case Ab_Db_Table::RELEASE_DELETE_WAIT:
                $this->release_status = Ab_Db_Table::RELEASE_DELETE_CHECK;
                break;

            default:
                $this->release_status = Ab_Db_Table::RELEASE_CREATE_CHECK;
        }
    }
}

