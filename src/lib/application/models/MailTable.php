<?php

class MailTable extends Ab_Db_Table
{
    protected $_name     = 'mail';
    protected $_rowClass = 'Mail';
    
    public function addMail($hash, $mail)
    {
        $row = $this->createRow();
        $row->hash = $hash;
        $row->mail = $mail;
        $row->save();
    }

    public function checkHash($hash) {
        $where = array(
            'hash = ?' => $hash,
        );
        $row = $this->fetchRow($where);
        if(!$row) {
            return false;
        }
        return $row;
    }
}

