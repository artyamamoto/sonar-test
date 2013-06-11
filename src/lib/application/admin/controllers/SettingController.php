<?php

/**
 * Setting controller
 */
class SettingController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'setting';

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
        );

        return $rules;
    }
}
