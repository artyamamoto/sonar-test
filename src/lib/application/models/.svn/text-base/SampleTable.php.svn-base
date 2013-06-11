<?php

class SampleTable extends Ab_Db_Table
{
    protected $_name     = 'sample';
    protected $_rowClass = 'Sample';

    protected $_forms = array(
        'chapter' => array(
            'label' => 'タイトル（章）',
        ),
        'title' => array(
            'label' => 'タイトル',
        ),
        'body' => array(
            'label' => '本文',
            'type'  => 'html',
        ),
        'comment' => array(
            'label' => 'コメント',
            'type'  => 'textarea',
            'cols'  => 40,
            'rows'  => 8,
        ),
        'category' => array(
            'label' => 'カテゴリ',
        ),
        'voice' => array(
            'label' => '音声登録',
            'type'  => 'file',
        ),
        'release_flag' => array(
            'label' => '公開',
            'type'  => 'select',
            'values' => array('1' => '公開', '0' => '非公開'),
        ),
        'release_date' => array(
            'label' => '公開日時',
            'type'  => 'datetime',
        ),
    );
}

