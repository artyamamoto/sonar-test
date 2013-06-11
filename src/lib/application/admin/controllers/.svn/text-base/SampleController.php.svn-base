<?php

/**
 * Sample controller
 */
class SampleController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'sample';

    public function getValidatorRules() {
        $rules = array(
            'chapter' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 8),
            ),
            'title' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 60),
            ),
            'release_flag' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
            'release_date' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
        );

        return $rules;
    }
}

