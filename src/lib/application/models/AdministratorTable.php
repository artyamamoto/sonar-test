<?php

class AdministratorTable extends Ab_Db_Table
{
    protected $_name     = 'administrator';
    protected $_rowClass = 'Administrator';

    protected $_forms = array(
        'name' => array(
            'label' => '氏名',
        ),
        'mail_address' => array(
            'label' => 'メールアドレス',
        ),
        'password' => array(
            'label' => 'パスワード',
            'type'  => 'password',
        ),
        'role' => array(
            'label' => '権限',
            'type'  => 'role',
        ),
    );

    /**
     * Get exist or new row.
     *
     * @param  array     $array
     * @return Ab_Db_Table_Row
     */
    public function getRow(array $array)
    {
        if(isset($array['password'])) {
            if(strlen($array['password']) > 0) {
                $array['password'] = md5($array['password']);
            } else {
                unset($array['password']);
            }
        }

        return parent::getRow($array);
    }
}

