<?php

class PageTable extends Ab_Db_Table
{
    protected $_name     = 'page';
    protected $_rowClass = 'Page';

    protected $_useRelease = true;

    protected $_forms = array(
        'name' => array(
            'label' => '管理名',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'action_code' => array(
            'label' => 'アクション',
        ),
        'content_type' => array(
            'label' => 'Content-type',
            'type'  => 'select',
            'values' => array('text/html; charset=UTF-8' => 'text/html; charset=UTF-8'),
        ),
        'is_close' => array(
            'label' => '終了画面表示',
            'type'  => 'select',
            'values' => array('1' => 'する', '0' => 'しない'),
        ),
        'source_mobile' => array(
            'label' => '携帯',
            'type'  => 'textarea',
            'rows'  => 25,
        ),
        'source_smartphone' => array(
            'label' => 'スマートフォン',
            'type'  => 'textarea',
            'rows'  => 25,
        ),
        /*
        'valid_flag' => array(
            'label' => '有効',
            'type'  => 'select',
            'values' => array('1' => '有効', '0' => '無効'),
        ),
        */
        'release_date' => array(
            'label' => '公開日時',
            'type'  => 'datetime',
        ),
    );
}

