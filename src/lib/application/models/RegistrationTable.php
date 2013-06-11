<?php

class RegistrationTable extends Ab_Db_Table
{
    protected $_name     = 'registration';
    protected $_rowClass = 'Registration';

    protected $_forms = array(
        'name' => array(
            'label' => '氏名',
        ),
        'mail_address' => array(
            'label' => 'メールアドレス',
        ),
        'uid' => array(
            'label' => 'UID',
        ),
        'data' => array(
            'label' => '応募データ',
            'type'  => 'json',
        ),
        'carrier' => array(
            'label' => 'キャリア',
            'type'  => 'select',
            'values' => array('1' => 'docomo', '2' => 'au', '3' => 'SoftBank', '4' => 'Android', '5' => 'iPhone'),
        ),
        'ip_address' => array(
            'label' => 'IPアドレス',
        ),
        'user_agent' => array(
            'label' => 'ユーザエージェント',
        ),
        'app_version' => array(
            'label' => 'アプリバージョン',
        ),
    );
}

