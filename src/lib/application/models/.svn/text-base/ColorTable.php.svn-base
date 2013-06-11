<?php

class ColorTable extends Ab_Db_Table
{
    protected $_name     = 'color';
    protected $_rowClass = 'Color';

    protected $_forms = array(
        'name' => array(
            'label' => '管理名',
        ),
        'code' => array(
            'label' => 'code',
        ),
        'value' => array(
            'label' => '値',
        ),
    );

    public function getByCode($code)
    {
        $row = $this->fetchRow(array('code = ?' => $code));

        return $row;
    }
}

