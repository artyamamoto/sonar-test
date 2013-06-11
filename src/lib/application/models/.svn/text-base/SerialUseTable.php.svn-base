<?php

class SerialUseTable extends Ab_Db_Table
{
    protected $_name     = 'serial_use';
    protected $_rowClass = 'SerialUse';


    protected $_forms = array(
        'n' => array(
            'label' => 'シリアル',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'target' => array(
            'label' => '対象',
        ),
        'uid' => array(
            'label' => 'UID',
        ),
    );

    /**
     * シリアルのチェック
     */
    public static function checkByUid($uid, $code, $target, $hash = null)
    {
        $where = array(
            'code = ?' => $code,
            'uid = ?' => $uid,
            'target = ?' => $target,
        );
        if(null !== $hash) {
            $where['hash = ?'] = $hash;
        }

        $table = new self();

        return $table->fetchAll($where);
    }
}

