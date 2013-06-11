<?php

class UidTable extends Ab_Db_Table
{
    protected $_name     = 'uid';
    protected $_rowClass = 'Uid';

    protected $_forms = array(
        'file_name' => array(
            'label' => '当選者データ',
            'type'  => 'file',
        ),
        'separator' => array(
            'label' => '区切り文字',
            'type' => 'select',
            'values' => array(
                'kanma' => 'カンマ',
                'tab' => 'タブ',
            ),
        ),
    );
}

