<?php

class ActionTable extends Ab_Db_Table
{
    protected $_name     = 'action';
    protected $_rowClass = 'Action';

    protected $_useRelease = true;

    protected $_forms = array(
        'name' => array(
            'label' => '管理名',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'source' => array(
            'label' => 'ソース',
            'type'  => 'textarea',
            'rows'  => 15,
        ),
        'comment' => array(
            'label' => 'コメント',
            'type'  => 'textarea',
            'rows'  => 5,
        ),
        'release_date' => array(
            'label' => '公開日時',
            'type'  => 'datetime',
        ),
    );
}

