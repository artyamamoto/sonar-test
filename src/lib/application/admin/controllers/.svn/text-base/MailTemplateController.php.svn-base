<?php

/**
 * MailTemplate controller
 */
class MailTemplateController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'mail_template';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_ACTION;

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
            'from' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
            'subject' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
            'body' => array(
                'Zend_Validate_NotEmpty' => array(),
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
        $row->subject = mb_convert_kana($row->subject, 'KV', 'UTF-8');
        $row->body = mb_convert_kana($row->body, 'KV', 'UTF-8');
    }
}

