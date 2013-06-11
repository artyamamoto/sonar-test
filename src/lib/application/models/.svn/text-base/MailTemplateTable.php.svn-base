<?php

class MailTemplateTable extends Ab_Db_Table
{
    protected $_name     = 'mail_template';
    protected $_rowClass = 'MailTemplate';

    protected $_useRelease = true;

    protected $_forms = array(
        'name' => array(
            'label' => '管理名',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'from' => array(
            'label' => '送信元',
        ),
        'subject' => array(
            'label' => '件名',
        ),
        'body' => array(
            'label' => '本文',
            'type'  => 'textarea',
            'rows'  => 25,
        ),
        'release_date' => array(
            'label' => '公開日時',
            'type'  => 'datetime',
        ),
    );
}

