<?php

class SerialNumber extends Ab_Db_Table_Row
{
    protected $_name       = 'serial_number';
    protected $_tableClass = 'SerialNumberTable';

    /**
     * シリアルの有効性をチェックする
     */
    public function isValid($uid, $code, $target, $hash = null)
    {
        if(strlen($uid) == 0) { throw new Exception('invalid uid'); }
        if(strlen($code) == 0) { throw new Exception('invalid code'); }
        if(strlen($target) == 0) { throw new Exception('invalid target'); }

        $serialTable = new SerialTable();
        $row = $serialTable->fetchRow(array('id = ?' => $this->serial_id));
        if($row->code != $code) {
            return false;
        }

        // 使用済みシリアルテーブルからレコードを取得
        $serialUseTable = new SerialUseTable();
        $where = array(
            'n = ?' => $this->n,
            'code = ?' => $code,
            'target = ?' => $target,
            //'uid != ?' => $uid,
        );
        //if(null !== $hash) {
        //    $where['hash != ?'] = $hash;
        //}
        $rows = $serialUseTable->fetchAll($where);

        // 該当するレコードがない場合はOK
        if(!$rows) {
            return true;
        }

        // 同じ対象・UID、（ハッシュ）での応募の場合はOK
        $find = false;
        foreach($rows as $row) {
            /*
            if($row->target == $target && $row->uid == $uid) {
                if(null !== $hash && $row->hash == $hash) {
                    continue;
                } elseif(null === $hash) {
                    continue;
                }
            }
            */

            $find = true;
        }
        if($find) {
            return false;
        }

        return true;
    }

    /**
     * シリアルを無効にする
     */
    public function invalidate($uid, $code, $target, $hash = null, $params = null)
    {
        if(strlen($uid) == 0) { throw new Exception('invalid uid'); }
        if(strlen($code) == 0) { throw new Exception('invalid code'); }
        if(strlen($target) == 0) { throw new Exception('invalid target'); }

        // すでに使用済みテーブルに保存されている場合は何もしない
        $serialUseTable = new SerialUseTable();
        $where = array(
            'n = ?' => $this->n,
            'code = ?' => $code,
            'target = ?' => $target,
        );
        $row = $serialUseTable->fetchRow($where);
        if($row) {
            return;
        }

        // 使用済みシリアルテーブルに保存
        $serialUseTable = new SerialUseTable();
        $use = $serialUseTable->fetchNew();
        $use->n = $this->n;
        $use->code = $code;
        $use->uid = $uid;
        $use->target = $target;

        if(null !== $hash) {
            $use->hash = $hash;
        }
        if(null !== $params) {
            $use->params = json_encode($params);
        }

        $use->save();
    }
}

