<?php

/**
 * Color controller
 */
class ColorController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'color';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_SETTING;

    public function getValidatorRules() {
        $rules = array(
            'name' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'code' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'value' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
        );

        return $rules;
    }

    protected function _preSave($row)
    {
        parent::_preSave($row);

        // 英数を小文字に変換
        $row->value = strtolower($row->value);
    }
}

