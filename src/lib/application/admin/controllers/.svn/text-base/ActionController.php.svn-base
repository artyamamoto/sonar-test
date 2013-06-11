<?php

/**
 * Action controller
 */
class ActionController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'action';

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
            'release_date' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
        );

        return $rules;
    }
}

