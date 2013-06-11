<?php

/**
 * @category   Ab
 * @package    Ab_Validate
 */
class Ab_Validate_Kana extends Zend_Validate_Abstract
{
    const KANA = 'notKana';

    public function __construct()
    {
    }

    public function isValid($value)
    {
        $ret = preg_match("/[^ぁ-ゞー]/u", $value);

        if($ret) {
            $this->_error(self::KANA);
            return false;
        }

        return true;
    }
}
