<?php

class SerialTable extends Ab_Db_Table
{
    protected $_name     = 'serial';
    protected $_rowClass = 'Serial';

    protected $_forms = array(
        'name' => array(
            'label' => '管理名',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'file_name' => array(
            'label' => 'シリアルファイル',
            'type'  => 'file',
        ),
    );
}

