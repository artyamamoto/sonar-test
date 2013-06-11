<?php

/**
 * Data controller
 */
class DataController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'data';

    public function getValidatorRules() {
        $rules = array(
            'name' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'table_name' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
        );

        return $rules;
    }
}

