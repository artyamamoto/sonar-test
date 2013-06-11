<?php

class SerialNumberTable extends Ab_Db_Table
{
    protected $_name     = 'serial_number';
    protected $_rowClass = 'SerialNumber';

    /**
     * シリアルのチェック
     *
     * @param   Ab_Controller_Request_Http  $request    リクエスト
     * @param   string      $code       シリアル種別
     * @param   string      $target     対象
     * @param   string      $hash       ハッシュ
     * @return  SerialNumber
     */
    public static function checkSerial($request, $code, $target, $hash = null)
    {
        $serial = $request->serial;

        if(strlen($serial) == 0) {
            return false;
        }

        // シリアルの有効性チェック
        $table = new self();
        $where = array(
            'n = ?' => $serial,
        );
        $row = $table->fetchRow($where, 'id DESC');

        if(!$row || !$row->isValid($request->uid, $code, $target, $hash)) {
            return false;
        }

        return $row;
    }
}

