<?php

/**
 * Page controller
 */
class PageController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'page';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_TEMPLATE;

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

    protected function _preSave($row)
    {
        parent::_preSave($row);

        // 半角カナを全角に変換
        $row->source_smartphone = mb_convert_kana($row->source_smartphone, 'KV', 'UTF-8');
    }
}

